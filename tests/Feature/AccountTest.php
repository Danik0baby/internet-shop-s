<?php

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows only the orders of the current user', function () {
    $user = User::factory()->create();
    $ownOrder = Order::factory()->create([
        'user_id' => $user->getKey(),
        'number' => 'NV-000001',
    ]);
    $strangerOrder = Order::factory()->create(['number' => 'NV-999999']);

    $this->actingAs($user)
        ->get(route('account'))
        ->assertOk()
        ->assertSee($ownOrder->number)
        ->assertDontSee($strangerOrder->number);
});

it('updates the customer profile', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->patch(route('account.update'), [
            'name' => 'Новое имя',
            'email' => 'new@example.com',
        ])
        ->assertRedirect();

    $this->assertDatabaseHas('users', [
        'id' => $user->getKey(),
        'name' => 'Новое имя',
        'email' => 'new@example.com',
    ]);
});

it('shows an order to its owner', function () {
    $user = User::factory()->create();
    $order = Order::factory()->create([
        'user_id' => $user->getKey(),
        'number' => 'NV-123456',
    ]);

    $this->actingAs($user)
        ->get(route('account.order', $order))
        ->assertOk()
        ->assertSee('NV-123456');
});

it('forbids viewing another customer order', function () {
    $order = Order::factory()->create();
    $otherUser = User::factory()->create();

    $this->actingAs($otherUser)
        ->get(route('account.order', $order))
        ->assertForbidden();
});
