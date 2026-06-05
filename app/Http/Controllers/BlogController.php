<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\PostRepositoryInterface;
use App\Models\PostCategory;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function __construct(
        protected PostRepositoryInterface $postRepo,
    ) {}

    public function index(): View
    {
        return view('blog.index', [
            'posts'      => $this->postRepo->published()->paginate(6),
            'categories' => PostCategory::withCount('posts')->get(),
        ]);
    }

    public function show(string $slug): View
    {
        $post = $this->postRepo->findBySlug($slug);
        abort_if(! $post || ! $post->is_published, 404);

        return view('blog.show', [
            'post'        => $post,
            'recentPosts' => $this->postRepo->recent(3),
        ]);
    }
}
