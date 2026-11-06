<?php

use App\Cart;
use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('redirects guests to login', function () {
    $this->get(route('checkout.create'))
        ->assertRedirect(route('login'));
});

it('redirects to the cart when it is empty', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('checkout.create'))
        ->assertRedirect(route('cart.index'));
});

it('places an order and decrements product stock', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create(['stock' => 5, 'price' => 10_000]);

    $this->actingAs($user)->post(route('cart.store', $product), ['quantity' => 2]);

    $response = $this->actingAs($user)->post(route('checkout.store'), [
        'customer_name' => 'Иван Петров',
        'email' => 'ivan@example.com',
        'phone' => '+7 900 000-00-00',
        'city' => 'Москва',
        'address' => 'ул. Тестовая, 1',
        'comment' => 'Позвонить перед доставкой',
        'delivery_method' => 'courier',
        'payment_method' => 'cash',
    ]);

    $order = Order::query()->firstOrFail();

    $response->assertRedirect(route('checkout.success', $order));

    expect($order->status)->toBe(OrderStatus::New)
        ->and($order->total)->toBe(20_000)
        ->and($order->items()->count())->toBe(1)
        ->and($product->fresh()->stock)->toBe(3)
        ->and(app(Cart::class)->isEmpty())->toBeTrue();

    $this->actingAs($user)
        ->get(route('checkout.success', $order))
        ->assertOk()
        ->assertSee($order->number);
});

it('validates checkout fields', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create(['stock' => 2]);

    $this->actingAs($user)->post(route('cart.store', $product));
    $this->actingAs($user)
        ->post(route('checkout.store'), [])
        ->assertSessionHasErrors(['customer_name', 'email', 'phone', 'city', 'address', 'delivery_method', 'payment_method']);

    expect(Order::query()->count())->toBe(0);
});

it('forbids viewing another customer order', function () {
    $order = Order::factory()->create();
    $otherUser = User::factory()->create();

    $this->actingAs($otherUser)
        ->get(route('checkout.success', $order))
        ->assertForbidden();
});
