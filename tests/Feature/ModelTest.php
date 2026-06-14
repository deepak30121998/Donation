<?php

use App\Enums\DonationPaymentMethod;
use App\Enums\DonationStatus;
use App\Models\Cause;
use App\Models\GalleryCategory;
use App\Models\ContactSubmission;
use App\Models\Donation;
use App\Models\GalleryItem;
use App\Models\NewsletterSubscriber;
use App\Models\Post;
use App\Models\Program;
use App\Models\Service;
use App\Models\User;

// ─── Slug Generation ────────────────────────────────────────────────────────

it('generates slug automatically from title for Post', function () {
    $author = User::first() ?? User::factory()->create();

    $post = Post::create([
        'author_id'    => $author->id,
        'title'        => 'My Unique Slug Post Test',
        'body'         => 'Body content',
        'is_published' => false,
    ]);

    $post->refresh();
    expect($post->slug)->toBe('my-unique-slug-post-test');
});

it('generates slug automatically for Service', function () {
    $service = Service::create([
        'title'     => 'Healthcare Support Service',
        'body'      => 'Service body',
        'is_active' => true,
    ]);

    $service->refresh();
    expect($service->slug)->toBe('healthcare-support-service');
});

it('generates slug automatically for Program', function () {
    $program = Program::create([
        'title'     => 'Youth Education Program Test',
        'body'      => 'Program body',
        'is_active' => true,
    ]);

    $program->refresh();
    expect($program->slug)->toBe('youth-education-program-test');
});

it('slug is unique — appends suffix on duplicate', function () {
    $author = User::first() ?? User::factory()->create();

    $post1 = Post::create([
        'author_id'    => $author->id,
        'title'        => 'Duplicate Slug Title Unique',
        'body'         => 'Body 1',
        'is_published' => false,
    ]);

    $post2 = Post::create([
        'author_id'    => $author->id,
        'title'        => 'Duplicate Slug Title Unique',
        'body'         => 'Body 2',
        'is_published' => false,
    ]);

    $post1->refresh();
    $post2->refresh();

    expect($post1->slug)->not->toBe($post2->slug);
});

// ─── Post Published Scope ────────────────────────────────────────────────────

it('post published scope only returns is_published=true with past published_at', function () {
    $author = User::first() ?? User::factory()->create();

    $published = Post::create([
        'author_id'    => $author->id,
        'title'        => 'Scope Published Post',
        'body'         => 'Body',
        'is_published' => true,
        'published_at' => now()->subHour(),
    ]);

    $unpublished = Post::create([
        'author_id'    => $author->id,
        'title'        => 'Scope Unpublished Post',
        'body'         => 'Body',
        'is_published' => false,
        'published_at' => null,
    ]);

    $publishedIds = Post::published()->pluck('id');

    expect($publishedIds)->toContain($published->id);
    expect($publishedIds)->not->toContain($unpublished->id);
});

// ─── Cause Attributes ───────────────────────────────────────────────────────

it('cause progress_percent attribute calculates correctly', function () {
    $cause = Cause::create([
        'title'         => 'Progress Cause',
        'goal_amount'   => 1000,
        'raised_amount' => 400,
        'is_active'     => true,
    ]);

    expect($cause->progress_percent)->toBe(40);
});

it('cause progress_percent caps at 100 even if raised > goal', function () {
    $cause = Cause::create([
        'title'         => 'Over Goal Cause',
        'goal_amount'   => 1000,
        'raised_amount' => 1500,
        'is_active'     => true,
    ]);

    expect($cause->progress_percent)->toBe(100);
});

// ─── Donation Accessors & Casts ──────────────────────────────────────────────

it('donation donor_full_name accessor concatenates names', function () {
    $donation = Donation::create([
        'donor_first_name' => 'John',
        'donor_last_name'  => 'Doe',
        'donor_email'      => 'john.doe@example.com',
        'amount'           => 50,
        'payment_method'   => DonationPaymentMethod::Online->value,
        'status'           => DonationStatus::Pending->value,
        'donated_at'       => now(),
    ]);

    expect($donation->donor_full_name)->toBe('John Doe');
});

it('donation status casts to DonationStatus enum', function () {
    $donation = Donation::create([
        'donor_first_name' => 'Jane',
        'donor_last_name'  => 'Doe',
        'donor_email'      => 'jane.enum@example.com',
        'amount'           => 25,
        'payment_method'   => 'online',
        'status'           => 'pending',
        'donated_at'       => now(),
    ]);

    $donation->refresh();
    expect($donation->status)->toBeInstanceOf(DonationStatus::class);
    expect($donation->status)->toBe(DonationStatus::Pending);
});

it('donation payment_method casts to DonationPaymentMethod enum', function () {
    $donation = Donation::create([
        'donor_first_name' => 'Bob',
        'donor_last_name'  => 'Builder',
        'donor_email'      => 'bob.enum@example.com',
        'amount'           => 30,
        'payment_method'   => 'offline',
        'donated_at'       => now(),
    ]);

    $donation->refresh();
    expect($donation->payment_method)->toBeInstanceOf(DonationPaymentMethod::class);
    expect($donation->payment_method)->toBe(DonationPaymentMethod::Offline);
});

// ─── GalleryItem Category Cast ───────────────────────────────────────────────

it('gallery_item belongs to a GalleryCategory', function () {
    $cat = GalleryCategory::firstOrCreate(
        ['slug' => 'test-cat'],
        ['name' => 'Test Cat', 'order' => 99, 'is_active' => true]
    );

    $item = GalleryItem::create([
        'title'               => 'Test Gallery Item',
        'gallery_category_id' => $cat->id,
        'is_active'           => true,
    ]);

    $item->refresh();
    expect($item->galleryCategory)->toBeInstanceOf(GalleryCategory::class);
    expect($item->galleryCategory->slug)->toBe('test-cat');
    expect($item->categoryClass)->toBe('test-cat');

    $item->delete();
    $cat->delete();
});

// ─── Soft Deletes ────────────────────────────────────────────────────────────

it('soft delete hides service from queries', function () {
    $service = Service::create([
        'title'     => 'Service To Soft Delete',
        'body'      => 'Body',
        'is_active' => true,
    ]);

    $serviceId = $service->id;
    $service->delete();

    $found = Service::find($serviceId);
    expect($found)->toBeNull();

    $foundWithTrashed = Service::withTrashed()->find($serviceId);
    expect($foundWithTrashed)->not->toBeNull();
});

it('soft delete hides post from queries', function () {
    $author = User::first() ?? User::factory()->create();

    $post = Post::create([
        'author_id'    => $author->id,
        'title'        => 'Post To Soft Delete',
        'body'         => 'Body',
        'is_published' => false,
    ]);

    $postId = $post->id;
    $post->delete();

    $found = Post::find($postId);
    expect($found)->toBeNull();

    $foundWithTrashed = Post::withTrashed()->find($postId);
    expect($foundWithTrashed)->not->toBeNull();
});

// ─── Default Values ──────────────────────────────────────────────────────────

it('contact_submission is_read defaults to false', function () {
    $submission = ContactSubmission::create([
        'first_name' => 'Default',
        'last_name'  => 'Test',
        'email'      => 'default.isread@example.com',
    ]);

    $submission->refresh();
    expect($submission->is_read)->toBeFalse();
});

it('newsletter_subscriber is_active defaults to true', function () {
    $subscriber = NewsletterSubscriber::create([
        'email'         => 'default.active@example.com',
        'subscribed_at' => now(),
    ]);

    $subscriber->refresh();
    expect($subscriber->is_active)->toBeTrue();
});
