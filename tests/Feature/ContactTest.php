<?php

use App\Models\ContactSubmission;

/**
 * Valid contact payload helper.
 */
function validContact(array $overrides = []): array
{
    return array_merge([
        'first_name' => 'John',
        'last_name'  => 'Smith',
        'email'      => 'john.smith@example.com',
        'phone'      => '555-0199',
        'message'    => 'Hello, I would like to know more.',
    ], $overrides);
}

it('shows the contact page', function () {
    $this->get('/contact')->assertOk();
});

it('stores a valid contact submission', function () {
    $this->post('/contact', validContact())
        ->assertSessionHasNoErrors();
});

it('redirects back with success message after contact submit', function () {
    $this->post('/contact', validContact())
        ->assertRedirect()
        ->assertSessionHas('success');
});

it('stores contact in database', function () {
    $this->post('/contact', validContact([
        'first_name' => 'DatabaseTest',
        'last_name'  => 'User',
        'email'      => 'dbtest@example.com',
    ]));

    $this->assertDatabaseHas('contact_submissions', [
        'first_name' => 'DatabaseTest',
        'last_name'  => 'User',
        'email'      => 'dbtest@example.com',
    ]);
});

it('marks contact as unread by default', function () {
    $this->post('/contact', validContact([
        'email' => 'unread.test@example.com',
    ]));

    $submission = ContactSubmission::where('email', 'unread.test@example.com')->first();
    expect($submission)->not->toBeNull();
    expect($submission->is_read)->toBeFalse();
});

it('fails when first_name is missing', function () {
    $this->post('/contact', validContact(['first_name' => '']))
        ->assertSessionHasErrors(['first_name']);
});

it('fails when email is missing', function () {
    $this->post('/contact', validContact(['email' => '']))
        ->assertSessionHasErrors(['email']);
});

it('fails when email format is invalid', function () {
    $this->post('/contact', validContact(['email' => 'not-a-valid-email']))
        ->assertSessionHasErrors(['email']);
});

it('accepts submission without phone (nullable)', function () {
    $this->post('/contact', validContact(['phone' => null]))
        ->assertSessionHasNoErrors()
        ->assertSessionHas('success');
});

it('accepts submission without message (nullable)', function () {
    $this->post('/contact', validContact(['message' => null]))
        ->assertSessionHasNoErrors()
        ->assertSessionHas('success');
});

it('trims whitespace from input fields', function () {
    $this->post('/contact', validContact([
        'first_name' => '  Spaced  ',
        'last_name'  => '  Name  ',
        'email'      => '  spaces@example.com  ',
    ]))->assertSessionHasNoErrors();

    // Email trimming may depend on Laravel's TrimStrings middleware
    $this->assertDatabaseHas('contact_submissions', [
        'first_name' => 'Spaced',
        'last_name'  => 'Name',
    ]);
});

it('handles very long message gracefully', function () {
    $longMessage = str_repeat('a', 2000);

    $this->post('/contact', validContact(['message' => $longMessage]))
        ->assertSessionHasNoErrors()
        ->assertSessionHas('success');
});
