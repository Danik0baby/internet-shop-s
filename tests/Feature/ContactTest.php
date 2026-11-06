<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('stores a contact message', function () {
    $this->post(route('contacts.store'), [
        'name' => 'Иван Петров',
        'email' => 'ivan@example.com',
        'message' => 'Здравствуйте, помогите с выбором ноутбука.',
    ])->assertRedirect(route('contacts'));

    $this->assertDatabaseHas('contact_messages', [
        'email' => 'ivan@example.com',
    ]);
});

it('validates the contact form', function () {
    $this->post(route('contacts.store'), [
        'name' => '',
        'email' => 'not-an-email',
        'message' => 'short',
    ])->assertSessionHasErrors(['name', 'email', 'message']);

    $this->assertDatabaseCount('contact_messages', 0);
});
