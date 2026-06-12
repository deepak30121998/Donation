<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    public function saved(Post $post): void
    {
        if ($post->is_published && ! $post->published_at) {
            $post->updateQuietly(['published_at' => now()]);
        }

        Cache::flush();
    }

    public function deleted(Post $post): void
    {
        Cache::flush();
    }
}
