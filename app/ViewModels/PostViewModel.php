<?php

namespace App\ViewModels;

use App\Models\Post;
use Illuminate\Support\Collection;

class PostViewModel
{
    public function __construct(
        public readonly Post $post,
        public readonly Collection $recentPosts,
    ) {}

    public function readingTime(): int
    {
        $wordCount = str_word_count(strip_tags($this->post->body ?? ''));

        return (int) max(1, ceil($wordCount / 200));
    }

    public function formattedDate(): string
    {
        return $this->post->published_at?->format('d M Y') ?? $this->post->created_at->format('d M Y');
    }

    public function authorName(): string
    {
        return $this->post->author?->name ?? 'Admin';
    }

    public function shareUrl(string $platform): string
    {
        $url = urlencode(url()->current());
        $title = urlencode($this->post->title);

        return match ($platform) {
            'facebook' => "https://www.facebook.com/sharer/sharer.php?u={$url}",
            'twitter'  => "https://twitter.com/intent/tweet?url={$url}&text={$title}",
            'linkedin' => "https://www.linkedin.com/sharing/share-offsite/?url={$url}",
            default    => url()->current(),
        };
    }

    public function toArray(): array
    {
        return [
            'post'         => $this->post,
            'recentPosts'  => $this->recentPosts,
            'readingTime'  => $this->readingTime(),
            'formattedDate'=> $this->formattedDate(),
            'authorName'   => $this->authorName(),
        ];
    }
}
