<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Artisan;

class PostObserver
{
    public function saved(Post $post): void
    {
        if ($post->is_published && !$post->published_at) {
            $post->updateQuietly(['published_at' => now()]);
        }

        // Clear view cache when post is saved
        Artisan::call('view:clear');
    }

    public function deleted(Post $post): void
    {
        Artisan::call('view:clear');
    }
}
