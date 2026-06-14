<?php

namespace App\Console\Commands;

use App\Models\GalleryItem;
use App\Models\PageSection;
use App\Models\Program;
use App\Models\TeamMember;
use Illuminate\Console\Command;

class ImportStorageMedia extends Command
{
    protected $signature = 'media:import';
    protected $description = 'Import orphaned storage files into the media library';

    public function handle(): void
    {
        $storage = storage_path('app/public');

        // Team members: team-{n}.jpg → TeamMember id=n
        $teamMap = [
            'team-1.png' => 1,
            'team-1.jpg' => 1,
            'team-2.jpg' => 2,
            'team-3.jpg' => 3,
            'team-4.jpg' => 4,
            'team-5.jpg' => 5,
            'uuf-team-1.jpg' => 1,
            'uuf-team-3.jpg' => 3,
            'uuf-team-6.jpg' => 5,
        ];

        // Programs: filename keyword → Program id
        $programMap = [
            'program-gau-sewa.jpg'             => [1, 'thumb'],
            'program-women-entrepreneur.jpg'   => [2, 'thumb'],
            'program-child-education.jpg'      => [3, 'thumb'],
            'program-ration-distribution.jpg'  => [4, 'thumb'],
        ];

        // Gallery files (uuf-c*.jpg, uuf-r*.jpg) assigned round-robin to gallery items
        $galleryFiles = [];

        $this->info('Scanning storage directory...');

        // Collect all files grouped by filename
        $allFiles = [];
        foreach (glob("$storage/*/") as $dir) {
            foreach (glob($dir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE) as $file) {
                $filename = basename($file);
                $allFiles[$filename][] = $file;
            }
        }

        // --- Team Members ---
        $this->info('Importing team member photos...');
        $usedTeamFiles = [];
        foreach ($teamMap as $filename => $memberId) {
            if (isset($usedTeamFiles[$memberId])) continue; // one photo per member
            if (! isset($allFiles[$filename])) continue;

            $member = TeamMember::find($memberId);
            if (! $member) continue;

            if ($member->getMedia('photo')->isNotEmpty()) {
                $this->line("  Skip TeamMember#{$memberId} — already has photo");
                $usedTeamFiles[$memberId] = true;
                continue;
            }

            $filePath = $allFiles[$filename][0];
            try {
                $member->addMedia($filePath)
                    ->preservingOriginal()
                    ->toMediaCollection('photo');
                $this->info("  ✓ TeamMember#{$memberId} ({$member->name}) ← {$filename}");
                $usedTeamFiles[$memberId] = true;
            } catch (\Exception $e) {
                $this->error("  ✗ TeamMember#{$memberId}: {$e->getMessage()}");
            }
        }

        // --- Programs ---
        $this->info('Importing program images...');
        $usedPrograms = [];
        foreach ($programMap as $filename => [$programId, $collection]) {
            if (isset($usedPrograms[$programId])) continue;
            if (! isset($allFiles[$filename])) continue;

            $program = Program::find($programId);
            if (! $program) continue;

            if ($program->getMedia($collection)->isNotEmpty()) {
                $this->line("  Skip Program#{$programId} — already has image");
                $usedPrograms[$programId] = true;
                continue;
            }

            $filePath = $allFiles[$filename][0];
            try {
                $program->addMedia($filePath)
                    ->preservingOriginal()
                    ->toMediaCollection($collection);
                $this->info("  ✓ Program#{$programId} ({$program->title}) ← {$filename}");
                $usedPrograms[$programId] = true;
            } catch (\Exception $e) {
                $this->error("  ✗ Program#{$programId}: {$e->getMessage()}");
            }
        }

        // --- Gallery Items ---
        $this->info('Importing gallery images...');
        $galleryItems = GalleryItem::orderBy('id')->get();
        $galleryPatterns = array_merge(
            glob("$storage/*/uuf-c*.jpg"),
            glob("$storage/*/uuf-r*.jpg"),
            glob("$storage/*/uuf-r*.png"),
        );
        // deduplicate by filename, keep first occurrence
        $seen = [];
        $uniqueGallery = [];
        foreach ($galleryPatterns as $file) {
            $name = basename($file);
            if (! isset($seen[$name])) {
                $seen[$name] = true;
                $uniqueGallery[] = $file;
            }
        }

        foreach ($galleryItems as $index => $item) {
            if (! isset($uniqueGallery[$index])) break;
            if ($item->getMedia('gallery')->isNotEmpty()) {
                $this->line("  Skip GalleryItem#{$item->id} — already has image");
                continue;
            }
            $filePath = $uniqueGallery[$index];
            try {
                $item->addMedia($filePath)
                    ->preservingOriginal()
                    ->toMediaCollection('gallery');
                $this->info("  ✓ GalleryItem#{$item->id} ({$item->title}) ← " . basename($filePath));
            } catch (\Exception $e) {
                $this->error("  ✗ GalleryItem#{$item->id}: {$e->getMessage()}");
            }
        }

        // --- PageSections ---
        $this->info('Importing page section images...');

        $storage2 = storage_path('app/public');
        $pageSectionMap = [
            // [page, section_key, collection, file]
            ['home', 'about', 'image',   "$storage2/60/uuf-hero-1.jpg"],
            ['home', 'about', 'image_2', "$storage2/61/uuf-hero-2.jpg"],
        ];

        foreach ($pageSectionMap as [$page, $key, $collection, $filePath]) {
            if (! file_exists($filePath)) {
                $this->warn("  File not found: $filePath");
                continue;
            }
            $section = PageSection::where('page', $page)->where('section_key', $key)->first();
            if (! $section) {
                $this->warn("  PageSection not found: $page.$key");
                continue;
            }
            if ($section->getMedia($collection)->isNotEmpty()) {
                $this->line("  Skip PageSection $page.$key/$collection — already has image");
                continue;
            }
            try {
                $section->addMedia($filePath)
                    ->preservingOriginal()
                    ->toMediaCollection($collection);
                $this->info("  ✓ PageSection $page.$key/$collection ← " . basename($filePath));
            } catch (\Exception $e) {
                $this->error("  ✗ PageSection $page.$key/$collection: {$e->getMessage()}");
            }
        }

        $this->info('Done!');
    }
}
