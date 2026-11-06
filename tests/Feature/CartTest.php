<?php

use App\Cart;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('adds a product to the cart', function () {
    $product = Product::factory()->create(['stock' => 5]);

    $this->post(route('cart.store', $product))
        ->assertRedirect();

    expect(app(Cart::class)->count())->toBe(1);

    $this->get(route('cart.index'))
        ->assertOk()
        ->assertSee($product->name);
});

it('respects the requested quantity and available stock', function () {
    $product = Product::factory()->create(['stock' => 3]);

    $this->post(route('cart.store', $product), ['quantity' => 10])
        ->assertRedirect();

    expect(app(Cart::class)->count())->toBe(3);
});

it('does not add an out of stock product', function () {
    $product = Product::factory()->create(['stock' => 0]);

    $this->post(route('cart.store', $product))
        ->assertRedirect();

    expect(app(Cart::class)->isEmpty())->toBeTrue();
});

it('updates the quantity of a cart line', function () {
    $product = Product::factory()->create(['stock' => 10]);

    $this->post(route('cart.store', $product), ['quantity' => 2]);

    $this->patch(route('cart.update', $product), ['quantity' => 4])
        ->assertRedirect();

    expect(app(Cart::class)->count())->toBe(4);
});

it('removes a product from the cart', function () {
    $product = Product::factory()->create(['stock' => 10]);

    $this->post(route('cart.store', $product));
    $this->delete(route('cart.destroy', $product))
        ->assertRedirect();

    expect(app(Cart::class)->isEmpty())->toBeTrue();
});

it('shows an empty cart state', function () {
    $this->get(route('cart.index'))
        ->assertOk()
        ->assertSee('Корзина пуста');
});
