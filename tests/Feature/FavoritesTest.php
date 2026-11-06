<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('requires authentication to use favorites', function () {
    $product = Product::factory()->create();

    $this->get(route('favorites.index'))->assertRedirect(route('login'));
    $this->post(route('favorites.toggle', $product))->assertRedirect(route('login'));
});

it('adds and removes a product from favorites', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();

    $this->actingAs($user)
        ->post(route('favorites.toggle', $product))
        ->assertRedirect();

    $this->assertDatabaseHas('favorites', [
        'user_id' => $user->getKey(),
        'product_id' => $product->getKey(),
    ]);

    $this->actingAs($user)
        ->get(route('favorites.index'))
        ->assertOk()
        ->assertSee($product->name);

    $this->actingAs($user)->post(route('favorites.toggle', $product));

    $this->assertDatabaseMissing('favorites', [
        'user_id' => $user->getKey(),
        'product_id' => $product->getKey(),
    ]);
});

it('shows an empty favorites state', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('favorites.index'))
        ->assertOk()
        ->assertSee('В избранном пока пусто');
});
