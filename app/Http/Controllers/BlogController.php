<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\PostRepositoryInterface;
use App\Models\PostCategory;
use App\ViewModels\PostViewModel;
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

        $vm = new PostViewModel(
            post:        $post,
            recentPosts: collect($this->postRepo->recent(3)),
        );

        return view('blog.show', array_merge($vm->toArray(), [
            'readingTime'   => $vm->readingTime(),
            'formattedDate' => $vm->formattedDate(),
            'authorName'    => $vm->authorName(),
            'shareUrls'     => [
                'facebook' => $vm->shareUrl('facebook'),
                'twitter'  => $vm->shareUrl('twitter'),
                'linkedin' => $vm->shareUrl('linkedin'),
            ],
        ]));
    }
}
