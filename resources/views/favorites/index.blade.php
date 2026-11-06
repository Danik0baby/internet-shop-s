@extends('layouts.app')

@section('title', 'Избранное — '.config('shop.name', 'NOVA'))

@section('content')
    <section class="container-page pt-10 sm:pt-14">
        <nav class="flex items-center gap-2 text-xs font-medium text-slate-500" aria-label="Хлебные крошки">
            <a href="{{ route('home') }}" class="transition hover:text-slate-900">Главная</a>
            <span aria-hidden="true">/</span>
            <span class="text-slate-900">Избранное</span>
        </nav>

        <div class="mt-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">Избранное</h1>
                <p class="mt-3 text-base text-slate-600">Товары, которые вы сохранили.</p>
            </div>
            <a href="{{ route('account') }}" class="btn-secondary">Личный кабинет</a>
        </div>
    </section>

    <section class="container-page pb-20 pt-10">
        @if ($products->isEmpty())
            <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center">
                <span class="grid h-16 w-16 mx-auto place-items-center rounded-full bg-slate-100 text-slate-400">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.5s-7.5-4.6-7.5-9.8A4.2 4.2 0 0 1 12 8a4.2 4.2 0 0 1 7.5 2.7c0 5.2-7.5 9.8-7.5 9.8Z" />
                    </svg>
                </span>
                <h2 class="mt-5 text-lg font-semibold text-slate-900">В избранном пока пусто</h2>
                <p class="mt-2 text-sm text-slate-500">Откройте карточку товара и нажмите «В избранное».</p>
                <a href="{{ route('catalog') }}" class="btn-primary mt-6">Перейти в каталог</a>
            </div>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <div class="mt-10">
                {{ $products->links() }}
            </div>
        @endif
    </section>
@endsection
