<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('registers a new user and signs them in', function () {
    $response = $this->post(route('register.store'), [
        'name' => 'Иван Петров',
        'email' => 'ivan@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'terms' => '1',
    ]);

    $response->assertRedirect(route('catalog'));
    $this->assertAuthenticated();

    expect(User::where('email', 'ivan@example.com')->exists())->toBeTrue();
});

it('rejects registration with invalid data', function () {
    $response = $this->from(route('register'))->post(route('register.store'), [
        'name' => '',
        'email' => 'not-an-email',
        'password' => 'short',
        'password_confirmation' => 'different',
        'terms' => '',
    ]);

    $response->assertRedirect(route('register'));
    $response->assertSessionHasErrors(['name', 'email', 'password', 'terms']);
    $this->assertGuest();

    expect(User::count())->toBe(0);
});

it('rejects duplicate email addresses', function () {
    User::factory()->create(['email' => 'taken@example.com']);

    $response = $this->from(route('register'))->post(route('register.store'), [
        'name' => 'Иван Петров',
        'email' => 'taken@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'terms' => '1',
    ]);

    $response->assertRedirect(route('register'));
    $response->assertSessionHasErrors('email');

    expect(User::count())->toBe(1);
});
