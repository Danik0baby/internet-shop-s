<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows a product detail page', function () {
    $product = Product::factory()->create([
        'name' => 'Тестовый товар',
        'slug' => 'test-product',
        'description' => 'Подробное описание товара',
    ]);

    $this->get(route('catalog.show', $product))
        ->assertOk()
        ->assertSee('Тестовый товар')
        ->assertSee('Подробное описание товара');
});

it('returns not found for a missing product', function () {
    $this->get(route('catalog.show', 'missing-product'))
        ->assertNotFound();
});

it('filters the catalog by category', function () {
    $phones = Category::factory()->create(['slug' => 'phones', 'name' => 'Смартфоны']);
    $audio = Category::factory()->create(['slug' => 'audio', 'name' => 'Аудио']);

    Product::factory()->create(['category_id' => $phones->getKey(), 'name' => 'Смартфон Тест']);
    Product::factory()->create(['category_id' => $audio->getKey(), 'name' => 'Наушники Тест']);

    $this->get(route('catalog', ['category' => 'phones']))
        ->assertOk()
        ->assertSee('Смартфон Тест')
        ->assertDontSee('Наушники Тест');
});

it('searches the catalog by name', function () {
    Product::factory()->create(['name' => 'Уникальный плеер']);
    Product::factory()->create(['name' => 'Другой товар']);

    $this->get(route('catalog', ['q' => 'плеер']))
        ->assertOk()
        ->assertSee('Уникальный плеер')
        ->assertDontSee('Другой товар');
});

it('sorts the catalog by price', function () {
    $cheap = Product::factory()->create(['name' => 'Дешёвый товар', 'price' => 1_000_00]);
    $expensive = Product::factory()->create(['name' => 'Дорогой товар', 'price' => 9_000_00]);

    $response = $this->get(route('catalog', ['sort' => 'price_asc']));

    $response->assertOk();
    $response->assertSeeInOrder([$cheap->name, $expensive->name]);
});
