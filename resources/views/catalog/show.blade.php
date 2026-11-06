@extends('layouts.app')

@section('title', $product->name.' — '.config('shop.name', 'NOVA'))
@section('meta_description', \Illuminate\Support\Str::limit($product->description, 150))

@section('content')
    @php
        $imageUrl = $product->image
            ? (\Illuminate\Support\Str::startsWith($product->image, ['http://', 'https://'])
                ? $product->image
                : \Illuminate\Support\Facades\Storage::url($product->image))
            : null;
    @endphp

    <section class="container-page pt-10 sm:pt-14">
        <nav class="flex flex-wrap items-center gap-2 text-xs font-medium text-slate-500" aria-label="Хлебные крошки">
            <a href="{{ route('home') }}" class="transition hover:text-slate-900">Главная</a>
            <span aria-hidden="true">/</span>
            <a href="{{ route('catalog') }}" class="transition hover:text-slate-900">Каталог</a>
            <span aria-hidden="true">/</span>
            <a href="{{ route('catalog', ['category' => $product->category->slug]) }}" class="transition hover:text-slate-900">
                {{ $product->category->name }}
            </a>
            <span aria-hidden="true">/</span>
            <span class="text-slate-900">{{ $product->name }}</span>
        </nav>

        <div class="mt-8 grid gap-10 lg:grid-cols-2 lg:gap-14">
            <div class="relative flex aspect-square items-center justify-center overflow-hidden rounded-[2rem] border border-slate-200 bg-white">
                @if ($imageUrl)
                    <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="h-full w-full object-contain p-6">
                @else
                    <span class="grid h-24 w-24 place-items-center rounded-3xl bg-slate-100 text-slate-300">
                        <svg class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m3 16 5-5 4 4 3-3 6 6M4 4h16a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1Z" />
                        </svg>
                    </span>
                @endif

                @if ($product->hasDiscount())
                    <span class="absolute left-6 top-6 rounded-full bg-rose-600 px-3 py-1 text-xs font-semibold text-white">
                        −{{ $product->discountPercent() }}%
                    </span>
                @endif
            </div>

            <div>
                <div class="flex flex-wrap items-center gap-2 text-xs">
                    <a href="{{ route('catalog', ['category' => $product->category->slug]) }}" class="rounded-full bg-slate-100 px-3 py-1 font-medium text-slate-600 transition hover:bg-slate-200">
                        {{ $product->category->name }}
                    </a>
                    @if ($product->brand)
                        <span class="rounded-full bg-slate-100 px-3 py-1 font-medium text-slate-600">{{ $product->brand }}</span>
                    @endif
                    @if ($product->reviews > 0)
                        <span class="flex items-center gap-1 font-medium text-slate-700">
                            <svg class="h-3.5 w-3.5 text-amber-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M10 15.3 4.1 18.4l1.1-6.6L.5 7.1l6.7-1L10 0l2.8 6.1 6.7 1-4.7 4.7 1.1 6.6z" />
                            </svg>
                            {{ $product->rating }}
                            <span class="font-normal text-slate-400">({{ $product->reviews }})</span>
                        </span>
                    @else
                        <span class="text-slate-400">Нет отзывов</span>
                    @endif
                </div>

                <h1 class="mt-4 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">{{ $product->name }}</h1>

                <div class="mt-6 flex flex-wrap items-end gap-3">
                    <p class="text-3xl font-bold tracking-tight text-slate-900">{{ $product->formatted_price }}</p>
                    @if ($product->hasDiscount())
                        <p class="pb-1 text-base font-medium text-slate-400 line-through">{{ $product->formatted_old_price }}</p>
                    @endif
                </div>

                <p class="mt-3 text-sm font-medium {{ $product->isInStock() ? 'text-emerald-600' : 'text-rose-600' }}">
                    {{ $product->isInStock() ? 'В наличии: '.$product->stock.' шт.' : 'Нет в наличии' }}
                </p>

                <p class="mt-6 text-base leading-7 text-slate-600">{{ $product->description }}</p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center">
                    @if ($product->isInStock())
                        <form method="POST" action="{{ route('cart.store', $product) }}" class="flex items-center gap-3">
                            @csrf
                            <div class="w-24">
                                <label for="quantity" class="sr-only">Количество</label>
                                <input
                                    id="quantity"
                                    name="quantity"
                                    type="number"
                                    min="1"
                                    max="{{ $product->stock }}"
                                    value="1"
                                    class="field-input text-center"
                                >
                            </div>
                            <button type="submit" class="btn-primary">В корзину</button>
                        </form>
                    @else
                        <span class="btn bg-slate-100 text-slate-400">Нет в наличии</span>
                    @endif

                    @auth
                        <form method="POST" action="{{ route('favorites.toggle', $product) }}">
                            @csrf
                            <button type="submit" class="btn-secondary">
                                {{ $isFavorite ? 'Убрать из избранного' : 'В избранное' }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn-secondary">Войти, чтобы сохранить</a>
                    @endauth
                </div>

                <dl class="mt-10 grid gap-4 border-t border-slate-200 pt-8 sm:grid-cols-2">
                    <div class="flex items-start gap-3">
                        <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-indigo-100 text-indigo-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h11v10H3zM14 10h4l3 3v4h-7zM7 21a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm10 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                            </svg>
                        </span>
                        <div>
                            <dt class="text-sm font-semibold text-slate-900">Доставка</dt>
                            <dd class="mt-1 text-xs leading-5 text-slate-500">Курьером или самовывозом</dd>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-emerald-100 text-emerald-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3 4 6v6c0 5 3.4 8.3 8 9 4.6-.7 8-4 8-9V6l-8-3Zm0 5v5m0 3h.01" />
                            </svg>
                        </span>
                        <div>
                            <dt class="text-sm font-semibold text-slate-900">Гарантия</dt>
                            <dd class="mt-1 text-xs leading-5 text-slate-500">Официальная гарантия производителя</dd>
                        </div>
                    </div>
                </dl>
            </div>
        </div>

        @if (! empty($product->specs))
            <div class="mt-16 rounded-[2rem] border border-slate-200 bg-white p-6 sm:p-8">
                <h2 class="text-xl font-bold tracking-tight text-slate-900">Характеристики</h2>
                <dl class="mt-6 grid gap-x-8 gap-y-4 sm:grid-cols-2">
                    @foreach ($product->specs as $name => $value)
                        <div class="flex items-start justify-between gap-4 border-b border-slate-100 pb-3">
                            <dt class="text-sm text-slate-500">{{ $name }}</dt>
                            <dd class="text-right text-sm font-medium text-slate-900">{{ is_array($value) ? implode(', ', $value) : $value }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        @endif

        @if ($related->isNotEmpty())
            <div class="mt-16">
                <div class="flex flex-wrap items-end justify-between gap-4">
                    <h2 class="text-2xl font-bold tracking-tight text-slate-900">Похожие товары</h2>
                    <a href="{{ route('catalog', ['category' => $product->category->slug]) }}" class="text-sm font-semibold text-indigo-600 transition hover:text-indigo-500">
                        Все в категории →
                    </a>
                </div>

                <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($related as $relatedProduct)
                        <x-product-card :product="$relatedProduct" />
                    @endforeach
                </div>
            </div>
        @endif
    </section>
@endsection
