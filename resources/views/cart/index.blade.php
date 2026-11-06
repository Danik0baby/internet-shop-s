@extends('layouts.app')

@section('title', 'Корзина — '.config('shop.name', 'NOVA'))

@section('content')
    <section class="container-page pt-10 sm:pt-14">
        <nav class="flex items-center gap-2 text-xs font-medium text-slate-500" aria-label="Хлебные крошки">
            <a href="{{ route('home') }}" class="transition hover:text-slate-900">Главная</a>
            <span aria-hidden="true">/</span>
            <span class="text-slate-900">Корзина</span>
        </nav>

        <h1 class="mt-6 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">Корзина</h1>
    </section>

    <section class="container-page pb-20 pt-10">
        @if ($items->isEmpty())
            <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center">
                <span class="grid h-16 w-16 mx-auto place-items-center rounded-full bg-slate-100 text-slate-400">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13 5.4 5M7 13l-2.3 4.6a1 1 0 0 0 .9 1.4H17M9 20a1 1 0 1 0 2 0 1 1 0 0 0-2 0Zm7 0a1 1 0 1 0 2 0 1 1 0 0 0-2 0Z" />
                    </svg>
                </span>
                <h2 class="mt-5 text-lg font-semibold text-slate-900">Корзина пуста</h2>
                <p class="mt-2 text-sm text-slate-500">Добавьте товары из каталога, чтобы оформить заказ.</p>
                <a href="{{ route('catalog') }}" class="btn-primary mt-6">Перейти в каталог</a>
            </div>
        @else
            <div class="grid gap-8 lg:grid-cols-[1fr_360px] lg:items-start">
                <div class="space-y-4">
                    @foreach ($items as $item)
                        @php
                            $product = $item['product'];
                            $itemImage = $product->image
                                ? (\Illuminate\Support\Str::startsWith($product->image, ['http://', 'https://'])
                                    ? $product->image
                                    : \Illuminate\Support\Facades\Storage::url($product->image))
                                : null;
                        @endphp

                        <article class="flex flex-col gap-4 rounded-3xl border border-slate-200 bg-white p-4 sm:flex-row sm:items-center sm:p-5">
                            <a href="{{ route('catalog.show', $product) }}" class="flex h-24 w-24 shrink-0 items-center justify-center overflow-hidden rounded-2xl bg-slate-100">
                                @if ($itemImage)
                                    <img src="{{ $itemImage }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                                @else
                                    <svg class="h-8 w-8 text-slate-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m3 16 5-5 4 4 3-3 6 6M4 4h16a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1Z" />
                                    </svg>
                                @endif
                            </a>

                            <div class="min-w-0 flex-1">
                                <p class="text-xs font-medium text-slate-400">{{ $product->category->name }}</p>
                                <h2 class="mt-1 truncate text-base font-semibold text-slate-900">
                                    <a href="{{ route('catalog.show', $product) }}" class="transition hover:text-indigo-600">{{ $product->name }}</a>
                                </h2>
                                <p class="mt-1 text-sm text-slate-500">{{ $product->formatted_price }} за штуку</p>

                                @unless ($product->isInStock())
                                    <p class="mt-2 text-xs font-semibold text-rose-600">Товара больше нет в наличии</p>
                                @endunless
                            </div>

                            <div class="flex flex-wrap items-center gap-3 sm:flex-col sm:items-end">
                                <form method="POST" action="{{ route('cart.update', $product) }}" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <label for="quantity-{{ $product->id }}" class="sr-only">Количество для {{ $product->name }}</label>
                                    <input
                                        id="quantity-{{ $product->id }}"
                                        name="quantity"
                                        type="number"
                                        min="0"
                                        max="{{ $product->stock }}"
                                        value="{{ $item['quantity'] }}"
                                        class="field-input w-20 py-2 text-center"
                                    >
                                    <button type="submit" class="rounded-full border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:border-slate-400">
                                        Обновить
                                    </button>
                                </form>

                                <div class="text-right">
                                    <p class="text-base font-bold text-slate-900">{{ number_format($item['total'] / 100, 0, '.', ' ') }} ₽</p>
                                    <form method="POST" action="{{ route('cart.destroy', $product) }}" class="mt-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-medium text-rose-600 transition hover:text-rose-500">
                                            Удалить
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <aside class="rounded-3xl border border-slate-200 bg-white p-6 lg:sticky lg:top-24">
                    <h2 class="text-lg font-semibold text-slate-900">Итого</h2>

                    <dl class="mt-5 space-y-3 text-sm">
                        <div class="flex items-center justify-between gap-3">
                            <dt class="text-slate-500">Товары</dt>
                            <dd class="font-medium text-slate-900">{{ number_format($subtotal / 100, 0, '.', ' ') }} ₽</dd>
                        </div>
                        <div class="flex items-center justify-between gap-3">
                            <dt class="text-slate-500">Доставка</dt>
                            <dd class="text-slate-500">при оформлении</dd>
                        </div>
                        <div class="flex items-center justify-between gap-3 border-t border-slate-200 pt-3">
                            <dt class="text-base font-semibold text-slate-900">К оплате</dt>
                            <dd class="text-xl font-bold text-slate-900">{{ number_format($subtotal / 100, 0, '.', ' ') }} ₽</dd>
                        </div>
                    </dl>

                    @auth
                        <a href="{{ route('checkout.create') }}" class="btn-primary mt-6 w-full">Оформить заказ</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary mt-6 w-full">Войти и оформить</a>
                        <p class="mt-3 text-center text-xs text-slate-500">Для оформления заказа нужен аккаунт.</p>
                    @endauth

                    <a href="{{ route('catalog') }}" class="btn-secondary mt-3 w-full">Продолжить покупки</a>
                </aside>
            </div>
        @endif
    </section>
@endsection
