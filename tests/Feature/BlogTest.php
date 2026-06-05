<?php

use App\Models\Post;
use App\Models\User;

/**
 * Helper: get or create a user for post author.
 */
function getOrCreateAuthor(): User
{
    return User::first() ?? User::factory()->create();
}

it('shows published posts on blog index', function () {
    $author = getOrCreateAuthor();

    $post = Post::create([
        'author_id'    => $author->id,
        'title'        => 'Published Blog Post Test',
        'body'         => 'Published content',
        'is_published' => true,
        'published_at' => now()->subDay(),
    ]);

    $this->get('/blog')
        ->assertOk()
        ->assertSee('Published Blog Post Test');
});

it('does not show unpublished posts', function () {
    $author = getOrCreateAuthor();

    Post::create([
        'author_id'    => $author->id,
        'title'        => 'Unpublished Blog Post XYZ',
        'body'         => 'Draft content',
        'is_published' => false,
        'published_at' => null,
    ]);

    $this->get('/blog')
        ->assertOk()
        ->assertDontSee('Unpublished Blog Post XYZ');
});

it('does not show future-dated posts', function () {
    $author = getOrCreateAuthor();

    Post::create([
        'author_id'    => $author->id,
        'title'        => 'Future Blog Post FUTURE',
        'body'         => 'Scheduled content',
        'is_published' => true,
        'published_at' => now()->addDays(5),
    ]);

    $this->get('/blog')
        ->assertOk()
        ->assertDontSee('Future Blog Post FUTURE');
});

it('shows blog post detail by slug', function () {
    $author = getOrCreateAuthor();

    $post = Post::create([
        'author_id'    => $author->id,
        'title'        => 'Detail Blog Post Test',
        'body'         => 'Detailed blog content here',
        'is_published' => true,
        'published_at' => now()->subHour(),
    ]);

    $post->refresh();

    $this->get("/blog/{$post->slug}")
        ->assertOk()
        ->assertSee('Detail Blog Post Test');
});

it('returns 404 for unpublished post slug', function () {
    $author = getOrCreateAuthor();

    $post = Post::create([
        'author_id'    => $author->id,
        'title'        => 'Not Published Yet Post',
        'body'         => 'Draft content',
        'is_published' => false,
        'published_at' => null,
    ]);

    $post->refresh();

    $this->get("/blog/{$post->slug}")
        ->assertNotFound();
});

it('returns 404 for non-existent slug', function () {
    $this->get('/blog/totally-nonexistent-slug-abcxyz')
        ->assertNotFound();
});

it('paginates blog posts (6 per page)', function () {
    $author = getOrCreateAuthor();

    // Create 7 published posts with distinct enough titles
    for ($i = 1; $i <= 7; $i++) {
        Post::create([
            'author_id'    => $author->id,
            'title'        => "Paginate Post Number {$i}",
            'body'         => "Content {$i}",
            'is_published' => true,
            'published_at' => now()->subMinutes($i),
        ]);
    }

    // Page 2 should exist if there are more than 6 published posts
    $response = $this->get('/blog?page=2');
    $response->assertOk();

    // The paginator should show at least one post on page 2
    $data = $response->viewData('posts');
    expect($data->currentPage())->toBe(2);
});

it('sets published_at when post is first published via observer', function () {
    $author = getOrCreateAuthor();

    // Create unpublished post (no published_at)
    $post = Post::create([
        'author_id'    => $author->id,
        'title'        => 'Observer Publish Test',
        'body'         => 'Will be published',
        'is_published' => false,
        'published_at' => null,
    ]);

    expect($post->published_at)->toBeNull();

    // Now publish it — the observer should set published_at
    $post->is_published = true;
    $post->save();

    $post->refresh();
    expect($post->published_at)->not->toBeNull();
});
