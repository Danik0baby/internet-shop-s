@extends('layouts.app')

@section('title', 'Каталог техники — NOVA')
@section('meta_description', 'Каталог NOVA: смартфоны, ноутбуки, аудио, гаджеты, аксессуары и умный дом с доставкой по России.')

@section('content')
    <section class="container-page pt-10 sm:pt-14">
        <nav class="flex items-center gap-2 text-xs font-medium text-slate-500" aria-label="Хлебные крошки">
            <a href="{{ route('home') }}" class="transition hover:text-slate-900">Главная</a>
            <span aria-hidden="true">/</span>
            <span class="text-slate-900">Каталог</span>
        </nav>

        <div class="mt-6 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">Каталог</h1>
                <p class="mt-4 max-w-2xl text-base leading-7 text-slate-600">
                    Только проверенная техника: понятные характеристики, честные цены и гарантия на каждое устройство.
                </p>
            </div>

            <p class="shrink-0 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-500">
                Товаров:
                <span data-product-count class="font-semibold text-slate-900">{{ count($products) }}</span>
            </p>
        </div>
    </section>

    <section class="container-page pb-20 pt-10">
        <div class="flex flex-wrap items-center gap-2" role="group" aria-label="Фильтр по категориям">
            <button type="button" data-filter="all" aria-pressed="true" class="filter-chip">Все товары</button>

            @foreach ($categories as $key => $category)
                <button type="button" data-filter="{{ $key }}" aria-pressed="false" class="filter-chip">
                    <span aria-hidden="true">{{ $category['icon'] }}</span>
                    {{ $category['label'] }}
                </button>
            @endforeach
        </div>

        <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
            @foreach ($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        <div data-empty-state class="mt-8 hidden rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center">
            <span class="text-4xl" aria-hidden="true">🔎</span>
            <h2 class="mt-4 text-lg font-semibold text-slate-900">В этой категории пока пусто</h2>
            <p class="mt-2 text-sm text-slate-500">Попробуйте выбрать другую категорию — в каталоге есть ещё много интересного.</p>
            <button type="button" data-filter="all" class="btn-secondary mt-6">Показать все товары</button>
        </div>

        <div class="mt-14 grid gap-4 rounded-3xl border border-slate-200 bg-white p-6 sm:grid-cols-3 sm:p-8">
            <div class="flex items-start gap-3">
                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-indigo-100 text-indigo-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h11v10H3zM14 10h4l3 3v4h-7zM7 21a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm10 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                    </svg>
                </span>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Доставка от 2 дней</h2>
                    <p class="mt-1 text-xs leading-5 text-slate-500">Бесплатно при заказе от 5 000 ₽</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-emerald-100 text-emerald-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3 4 6v6c0 5 3.4 8.3 8 9 4.6-.7 8-4 8-9V6l-8-3Zm0 5v5m0 3h.01" />
                    </svg>
                </span>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Гарантия 2 года</h2>
                    <p class="mt-1 text-xs leading-5 text-slate-500">Официальный сервис и поддержка</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-violet-100 text-violet-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 13a8 8 0 0 1 16 0M4 13v4a2 2 0 0 0 2 2h1v-6H6a2 2 0 0 0-2 2Zm16 0v4a2 2 0 0 1-2 2h-1v-6h1a2 2 0 0 1 2 2Z" />
                    </svg>
                </span>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Поможем с выбором</h2>
                    <p class="mt-1 text-xs leading-5 text-slate-500">Консультация 24/7 в чате и по телефону</p>
                </div>
            </div>
        </div>
    </section>
@endsection
