@extends('layouts.app')

@section('title', config('shop.name', 'NOVA').' — техника для жизни')
@section('meta_description', 'Магазин техники: смартфоны, ноутбуки, аудио и умные гаджеты. Актуальный каталог, доставка и поддержка.')

@section('content')
    @php
        $hero = $featuredProducts->first();
        $heroImage = $hero?->image
            ? (\Illuminate\Support\Str::startsWith($hero->image, ['http://', 'https://'])
                ? $hero->image
                : \Illuminate\Support\Facades\Storage::url($hero->image))
            : null;
    @endphp

    <section class="relative overflow-hidden">
        <div class="pointer-events-none absolute -left-32 -top-32 h-96 w-96 rounded-full bg-indigo-200/50 blur-3xl"></div>
        <div class="pointer-events-none absolute -right-24 top-24 h-96 w-96 rounded-full bg-violet-200/40 blur-3xl"></div>

        <div class="container-page grid items-center gap-16 py-16 lg:grid-cols-2 lg:py-24">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full border border-indigo-100 bg-indigo-50 px-4 py-1.5 text-xs font-semibold text-indigo-700">
                    <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                    Магазин техники
                </span>

                <h1 class="mt-6 text-4xl font-bold leading-[1.05] tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">
                    Техника, которая
                    <span class="bg-gradient-to-r from-indigo-600 via-violet-600 to-fuchsia-600 bg-clip-text text-transparent">упрощает жизнь</span>
                </h1>

                <p class="mt-6 max-w-xl text-base leading-7 text-slate-600 sm:text-lg">
                    Смартфоны, ноутбуки, аудио и умные гаджеты — с понятными характеристиками, доставкой по России и поддержкой, которая действительно отвечает.
                </p>

                <div class="mt-8 flex flex-wrap items-center gap-3">
                    <a href="{{ route('catalog') }}" class="btn-primary">
                        Смотреть каталог
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                        </svg>
                    </a>
                    <a href="{{ route('menu') }}" class="btn-secondary">Категории</a>
                </div>

                @if ($productCount > 0 || $categoryCount > 0)
                    <dl class="mt-12 grid max-w-lg grid-cols-3 gap-4 border-t border-slate-200 pt-8">
                        <div>
                            <dt class="text-xs font-medium text-slate-500">Товаров в каталоге</dt>
                            <dd class="mt-1 text-2xl font-bold tracking-tight text-slate-900">{{ $productCount }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-slate-500">Категорий</dt>
                            <dd class="mt-1 text-2xl font-bold tracking-tight text-slate-900">{{ $categoryCount }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-slate-500">Доставка</dt>
                            <dd class="mt-1 text-lg font-bold tracking-tight text-slate-900">по России</dd>
                        </div>
                    </dl>
                @endif
            </div>

            <div class="relative mx-auto w-full max-w-lg lg:max-w-none">
                <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-600 p-8 shadow-glow sm:p-10">
                    <div class="absolute -left-16 -top-16 h-56 w-56 rounded-full bg-white/15 blur-2xl"></div>
                    <div class="absolute -bottom-20 -right-10 h-64 w-64 rounded-full bg-fuchsia-300/20 blur-3xl"></div>

                    @if ($hero)
                        <a href="{{ route('catalog.show', $hero) }}" class="relative flex flex-col items-center text-center text-white">
                            <span class="rounded-full bg-white/15 px-3 py-1 text-xs font-medium backdrop-blur">{{ $hero->category->name }}</span>

                            @if ($heroImage)
                                <img src="{{ $heroImage }}" alt="{{ $hero->name }}" class="mt-8 h-48 w-auto rounded-2xl object-contain drop-shadow-2xl">
                            @else
                                <span class="mt-8 grid h-40 w-40 place-items-center rounded-3xl bg-white/10 text-white/70">
                                    <svg class="h-16 w-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m3 16 5-5 4 4 3-3 6 6M4 4h16a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1Z" />
                                    </svg>
                                </span>
                            @endif

                            <p class="mt-8 text-xl font-semibold tracking-tight">{{ $hero->name }}</p>
                            <p class="mt-2 text-2xl font-bold">{{ $hero->formatted_price }}</p>
                            <span class="mt-4 text-xs font-medium text-white/70">Смотреть товар →</span>
                        </a>
                    @else
                        <div class="relative flex flex-col items-center py-10 text-center text-white">
                            <span class="grid h-20 w-20 place-items-center rounded-3xl bg-white/15 text-2xl font-bold">
                                {{ mb_substr(config('shop.name', 'NOVA'), 0, 1) }}
                            </span>
                            <p class="mt-8 text-xl font-semibold">Каталог наполняется</p>
                            <p class="mt-3 max-w-xs text-sm text-white/70">
                                Товары появятся здесь, как только магазин добавит их через панель управления.
                            </p>
                            <a href="{{ route('contacts') }}" class="mt-6 rounded-full bg-white/15 px-5 py-2.5 text-xs font-semibold text-white backdrop-blur transition hover:bg-white/25">
                                Связаться с нами
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="container-page py-16">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-indigo-600">Категории</p>
                <h2 class="mt-3 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Выберите своё</h2>
            </div>
            <a href="{{ route('menu') }}" class="text-sm font-semibold text-indigo-600 transition hover:text-indigo-500">Все категории →</a>
        </div>

        @if ($categories->isEmpty())
            <div class="mt-10 rounded-3xl border border-dashed border-slate-300 bg-white p-10 text-center">
                <span class="grid h-14 w-14 mx-auto place-items-center rounded-2xl bg-slate-100 text-slate-400">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h10" />
                    </svg>
                </span>
                <h3 class="mt-5 text-lg font-semibold text-slate-900">Категории ещё не добавлены</h3>
                <p class="mt-2 text-sm text-slate-500">Они появятся здесь после наполнения каталога.</p>
            </div>
        @else
            <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
                @foreach ($categories as $category)
                    <a
                        href="{{ route('catalog', ['category' => $category->slug]) }}"
                        class="group rounded-2xl border border-slate-200 bg-white p-5 transition duration-300 hover:-translate-y-1 hover:border-indigo-200 hover:shadow-lg hover:shadow-slate-900/5"
                    >
                        <span class="grid h-12 w-12 place-items-center rounded-xl bg-slate-100 text-sm font-bold uppercase text-slate-500 transition group-hover:bg-indigo-50 group-hover:text-indigo-600">
                            {{ mb_substr($category->name, 0, 1) }}
                        </span>
                        <h3 class="mt-4 text-sm font-semibold text-slate-900">{{ $category->name }}</h3>
                        <p class="mt-1 text-xs leading-5 text-slate-500">
                            {{ trans_choice(':count товар|:count товара|:count товаров', $category->products_count, ['count' => $category->products_count]) }}
                        </p>
                    </a>
                @endforeach
            </div>
        @endif
    </section>

    <section class="container-page py-16">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-indigo-600">Каталог</p>
                <h2 class="mt-3 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Новинки</h2>
            </div>
            <a href="{{ route('catalog') }}" class="text-sm font-semibold text-indigo-600 transition hover:text-indigo-500">Смотреть все →</a>
        </div>

        @if ($featuredProducts->isEmpty())
            <div class="mt-10 rounded-3xl border border-dashed border-slate-300 bg-white p-10 text-center">
                <span class="grid h-14 w-14 mx-auto place-items-center rounded-2xl bg-slate-100 text-slate-400">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m3 16 5-5 4 4 3-3 6 6M4 4h16a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1Z" />
                    </svg>
                </span>
                <h3 class="mt-5 text-lg font-semibold text-slate-900">Здесь появятся товары</h3>
                <p class="mt-2 text-sm text-slate-500">Как только каталог наполнится, новинки будут показаны на этой странице.</p>
                <a href="{{ route('catalog') }}" class="btn-secondary mt-6">Перейти в каталог</a>
            </div>
        @else
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        @endif
    </section>

    <section class="container-page py-16">
        <div class="rounded-[2rem] border border-slate-200 bg-white p-8 sm:p-10">
            <div class="max-w-2xl">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-indigo-600">Почему мы</p>
                <h2 class="mt-3 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Заботимся о покупке целиком</h2>
                <p class="mt-4 text-base leading-7 text-slate-600">
                    От выбора до первого включения — без сюрпризов и скрытых условий.
                </p>
            </div>

            <div class="mt-10 grid gap-6 md:grid-cols-3">
                <div class="rounded-2xl bg-slate-50 p-6">
                    <span class="grid h-11 w-11 place-items-center rounded-xl bg-indigo-100 text-indigo-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h11v10H3zM14 10h4l3 3v4h-7zM7 21a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm10 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                        </svg>
                    </span>
                    <h3 class="mt-5 text-base font-semibold text-slate-900">Доставка по России</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600">Курьером или самовывозом — условия уточняются при оформлении заказа.</p>
                </div>

                <div class="rounded-2xl bg-slate-50 p-6">
                    <span class="grid h-11 w-11 place-items-center rounded-xl bg-emerald-100 text-emerald-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3 4 6v6c0 5 3.4 8.3 8 9 4.6-.7 8-4 8-9V6l-8-3Zm0 5v5m0 3h.01" />
                        </svg>
                    </span>
                    <h3 class="mt-5 text-base font-semibold text-slate-900">Гарантия производителя</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600">Официальные устройства и поддержка в сервисных вопросах.</p>
                </div>

                <div class="rounded-2xl bg-slate-50 p-6">
                    <span class="grid h-11 w-11 place-items-center rounded-xl bg-violet-100 text-violet-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 13a8 8 0 0 1 16 0M4 13v4a2 2 0 0 0 2 2h1v-6H6a2 2 0 0 0-2 2Zm16 0v4a2 2 0 0 1-2 2h-1v-6h1a2 2 0 0 1 2 2Z" />
                        </svg>
                    </span>
                    <h3 class="mt-5 text-base font-semibold text-slate-900">Поддержка</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600">Поможем выбрать и настроить устройство после покупки.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="container-page py-16">
        <div class="relative overflow-hidden rounded-[2rem] bg-slate-900 px-8 py-14 text-center sm:px-12">
            <div class="pointer-events-none absolute -left-20 -top-20 h-64 w-64 rounded-full bg-indigo-500/30 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-24 -right-10 h-72 w-72 rounded-full bg-fuchsia-500/20 blur-3xl"></div>

            <div class="relative mx-auto max-w-2xl">
                <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Готовы найти свою технику?</h2>
                <p class="mt-4 text-base leading-7 text-slate-300">
                    @auth
                        Перейдите в каталог, чтобы выбрать устройство и оформить заказ.
                    @else
                        Создайте аккаунт, чтобы оформлять заказы, сохранять избранное и следить за историей покупок.
                    @endauth
                </p>
                <div class="mt-8 flex flex-wrap justify-center gap-3">
                    @auth
                        <a href="{{ route('catalog') }}" class="btn bg-white text-slate-900 shadow-lg shadow-white/10 transition hover:-translate-y-0.5 hover:bg-slate-100">
                            Перейти в каталог
                        </a>
                        <a href="{{ route('account') }}" class="btn border border-white/20 text-white transition hover:border-white/40 hover:bg-white/5">
                            Личный кабинет
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn bg-white text-slate-900 shadow-lg shadow-white/10 transition hover:-translate-y-0.5 hover:bg-slate-100">
                            Создать аккаунт
                        </a>
                        <a href="{{ route('login') }}" class="btn border border-white/20 text-white transition hover:border-white/40 hover:bg-white/5">
                            Войти
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>
@endsection
