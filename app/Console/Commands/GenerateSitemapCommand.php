<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Program;
use App\Models\Service;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemapCommand extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the XML sitemap';

    public function handle(): int
    {
        $sitemap = Sitemap::create();

        // Static pages
        foreach ($this->staticPages() as [$loc, $priority, $freq]) {
            $sitemap->add(
                Url::create($loc)
                    ->setPriority($priority)
                    ->setChangeFrequency($freq)
            );
        }

        // Published posts
        Post::published()->each(function (Post $post) use ($sitemap) {
            $sitemap->add(
                Url::create(route('blog.show', $post->slug))
                    ->setLastModificationDate($post->updated_at)
                    ->setPriority(0.7)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            );
        });

        // Active services
        Service::where('is_active', true)->orderBy('order')->each(function (Service $service) use ($sitemap) {
            $sitemap->add(
                Url::create(route('services.show', $service->slug))
                    ->setLastModificationDate($service->updated_at)
                    ->setPriority(0.8)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        });

        // Active programs
        Program::where('is_active', true)->orderBy('order')->each(function (Program $program) use ($sitemap) {
            $sitemap->add(
                Url::create(route('programs.show', $program->slug))
                    ->setLastModificationDate($program->updated_at)
                    ->setPriority(0.7)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated at public/sitemap.xml');

        return self::SUCCESS;
    }

    private function staticPages(): array
    {
        return [
            [url('/'),               1.0, Url::CHANGE_FREQUENCY_DAILY],
            [route('about'),         0.8, Url::CHANGE_FREQUENCY_MONTHLY],
            [route('services.index'),0.9, Url::CHANGE_FREQUENCY_WEEKLY],
            [route('programs.index'),0.9, Url::CHANGE_FREQUENCY_WEEKLY],
            [route('blog.index'),    0.8, Url::CHANGE_FREQUENCY_DAILY],
            [route('team'),          0.6, Url::CHANGE_FREQUENCY_MONTHLY],
            [route('gallery'),       0.6, Url::CHANGE_FREQUENCY_MONTHLY],
            [route('testimonials'),  0.5, Url::CHANGE_FREQUENCY_MONTHLY],
            [route('faqs'),          0.6, Url::CHANGE_FREQUENCY_MONTHLY],
            [route('donation.index'),0.9, Url::CHANGE_FREQUENCY_WEEKLY],
            [route('contact.index'), 0.7, Url::CHANGE_FREQUENCY_YEARLY],
        ];
    }
}
