<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('renders the home page with products from the backend', function () {
    $category = Category::factory()->create(['name' => 'Ноутбуки']);

    Product::factory()->create([
        'category_id' => $category->getKey(),
        'name' => 'Тестовый ноутбук',
        'is_featured' => true,
        'stock' => 5,
    ]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Тестовый ноутбук')
        ->assertSee('Ноутбуки');
});

it('renders empty states when the catalog has no content', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Каталог наполняется')
        ->assertSee('Категории ещё не добавлены')
        ->assertSee('Здесь появятся товары');
});

it('renders the catalog page', function () {
    Product::factory()->create(['name' => 'Товар каталога']);

    $this->get(route('catalog'))
        ->assertOk()
        ->assertSee('Товар каталога');
});

it('renders an empty catalog state', function () {
    $this->get(route('catalog'))
        ->assertOk()
        ->assertSee('Каталог пока пуст');
});

it('renders the menu page', function () {
    Category::factory()->create(['name' => 'Аудио']);

    $this->get(route('menu'))
        ->assertOk()
        ->assertSee('Аудио');
});

it('renders the about page', function () {
    $this->get(route('about'))
        ->assertOk()
        ->assertSee('О магазине');
});

it('renders delivery and contacts pages', function () {
    $this->get(route('delivery'))
        ->assertOk()
        ->assertSee('Доставка и оплата');

    $this->get(route('contacts'))
        ->assertOk()
        ->assertSee('Обратная связь');
});

it('renders the auth pages', function () {
    $this->get(route('register'))
        ->assertOk()
        ->assertSee('Создать аккаунт');

    $this->get(route('login'))
        ->assertOk()
        ->assertSee('Запомнить меня');
});

it('returns a styled not found page', function () {
    $this->get('/missing-page')
        ->assertNotFound()
        ->assertSee('Страница не найдена');
});
