@extends('layouts.app')

@section('title', 'NOVA — техника для жизни')
@section('meta_description', 'Смартфоны, ноутбуки, аудио и умные гаджеты в NOVA. Быстрая доставка, гарантия и поддержка 24/7.')

@section('content')
    <section class="relative overflow-hidden">
        <div class="pointer-events-none absolute -left-32 -top-32 h-96 w-96 rounded-full bg-indigo-200/50 blur-3xl"></div>
        <div class="pointer-events-none absolute -right-24 top-24 h-96 w-96 rounded-full bg-violet-200/40 blur-3xl"></div>

        <div class="container-page grid items-center gap-16 py-16 lg:grid-cols-2 lg:py-24">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full border border-indigo-100 bg-indigo-50 px-4 py-1.5 text-xs font-semibold text-indigo-700">
                    <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                    Новая коллекция 2026
                </span>

                <h1 class="mt-6 text-4xl font-bold leading-[1.05] tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">
                    Техника, которая
                    <span class="bg-gradient-to-r from-indigo-600 via-violet-600 to-fuchsia-600 bg-clip-text text-transparent">упрощает жизнь</span>
                </h1>

                <p class="mt-6 max-w-xl text-base leading-7 text-slate-600 sm:text-lg">
                    Смартфоны, ноутбуки, аудио и умные гаджеты — с честными характеристиками, быстрой доставкой и поддержкой, которая действительно отвечает.
                </p>

                <div class="mt-8 flex flex-wrap items-center gap-3">
                    <a href="{{ route('catalog') }}" class="btn-primary">
                        Смотреть каталог
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                        </svg>
                    </a>
                    <a href="{{ route('about') }}" class="btn-secondary">О нас</a>
                </div>

                <dl class="mt-12 grid max-w-lg grid-cols-3 gap-4 border-t border-slate-200 pt-8">
                    <div>
                        <dt class="text-xs font-medium text-slate-500">Довольных клиентов</dt>
                        <dd class="mt-1 text-2xl font-bold tracking-tight text-slate-900">12 000+</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-slate-500">Средний рейтинг</dt>
                        <dd class="mt-1 flex items-center gap-1 text-2xl font-bold tracking-tight text-slate-900">
                            4.9
                            <svg class="h-5 w-5 text-amber-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M10 15.3 4.1 18.4l1.1-6.6L.5 7.1l6.7-1L10 0l2.8 6.1 6.7 1-4.7 4.7 1.1 6.6z" />
                            </svg>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-slate-500">Поддержка</dt>
                        <dd class="mt-1 text-2xl font-bold tracking-tight text-slate-900">24/7</dd>
                    </div>
                </dl>
            </div>

            <div class="relative mx-auto w-full max-w-lg lg:max-w-none">
                <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-600 p-8 shadow-glow sm:p-10">
                    <div class="absolute -left-16 -top-16 h-56 w-56 rounded-full bg-white/15 blur-2xl"></div>
                    <div class="absolute -bottom-20 -right-10 h-64 w-64 rounded-full bg-fuchsia-300/20 blur-3xl"></div>

                    <div class="relative flex flex-col items-center text-center text-white">
                        <span class="rounded-full bg-white/15 px-3 py-1 text-xs font-medium backdrop-blur">Nova Phone 14</span>
                        <span class="mt-8 text-[8rem] leading-none drop-shadow-2xl sm:text-[10rem]" aria-hidden="true">📱</span>
                        <p class="mt-8 text-2xl font-semibold tracking-tight">79 990 ₽</p>
                        <p class="mt-1 text-sm text-white/70">6.7" AMOLED · 256 ГБ · 50 Мп</p>
                    </div>
                </div>

                <div class="absolute -left-3 top-8 hidden items-center gap-3 rounded-2xl border border-slate-100 bg-white p-3 shadow-xl shadow-slate-900/10 sm:flex">
                    <span class="grid h-10 w-10 place-items-center rounded-xl bg-emerald-100 text-emerald-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h11v10H3zM14 10h4l3 3v4h-7zM7 21a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm10 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                        </svg>
                    </span>
                    <div>
                        <p class="text-xs font-semibold text-slate-900">Бесплатная доставка</p>
                        <p class="text-xs text-slate-500">от 5 000 ₽</p>
                    </div>
                </div>

                <div class="absolute -bottom-4 -right-2 hidden items-center gap-3 rounded-2xl border border-slate-100 bg-white p-3 shadow-xl shadow-slate-900/10 sm:flex">
                    <span class="grid h-10 w-10 place-items-center rounded-xl bg-amber-100 text-amber-600">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10 15.3 4.1 18.4l1.1-6.6L.5 7.1l6.7-1L10 0l2.8 6.1 6.7 1-4.7 4.7 1.1 6.6z" />
                        </svg>
                    </span>
                    <div>
                        <p class="text-xs font-semibold text-slate-900">4.9 из 5</p>
                        <p class="text-xs text-slate-500">2 400+ отзывов</p>
                    </div>
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
            <a href="{{ route('catalog') }}" class="text-sm font-semibold text-indigo-600 transition hover:text-indigo-500">Весь каталог →</a>
        </div>

        <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
            @foreach ($categories as $key => $category)
                <a
                    href="{{ route('catalog') }}?category={{ $key }}"
                    class="group rounded-2xl border border-slate-200 bg-white p-5 transition duration-300 hover:-translate-y-1 hover:border-indigo-200 hover:shadow-lg hover:shadow-slate-900/5"
                >
                    <span class="grid h-12 w-12 place-items-center rounded-xl bg-slate-100 text-2xl transition group-hover:bg-indigo-50" aria-hidden="true">
                        {{ $category['icon'] }}
                    </span>
                    <h3 class="mt-4 text-sm font-semibold text-slate-900">{{ $category['label'] }}</h3>
                    <p class="mt-1 text-xs leading-5 text-slate-500">{{ $category['description'] }}</p>
                </a>
            @endforeach
        </div>
    </section>

    <section class="container-page py-16">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-indigo-600">Популярное</p>
                <h2 class="mt-3 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Выбор покупателей</h2>
            </div>
            <a href="{{ route('catalog') }}" class="text-sm font-semibold text-indigo-600 transition hover:text-indigo-500">Смотреть все →</a>
        </div>

        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($featuredProducts as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </section>

    <section id="delivery" class="container-page py-16">
        <div class="rounded-[2rem] border border-slate-200 bg-white p-8 sm:p-10">
            <div class="max-w-2xl">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-indigo-600">Почему NOVA</p>
                <h2 class="mt-3 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Заботимся о покупке целиком</h2>
                <p class="mt-4 text-base leading-7 text-slate-600">
                    От выбора до первого включения — без сюрпризов, скрытых условий и долгих ожиданий.
                </p>
            </div>

            <div class="mt-10 grid gap-6 md:grid-cols-3">
                <div class="rounded-2xl bg-slate-50 p-6">
                    <span class="grid h-11 w-11 place-items-center rounded-xl bg-indigo-100 text-indigo-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h11v10H3zM14 10h4l3 3v4h-7zM7 21a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm10 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                        </svg>
                    </span>
                    <h3 class="mt-5 text-base font-semibold text-slate-900">Быстрая доставка</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600">По Москве — в день заказа, по России — от двух дней. Бесплатно от 5 000 ₽.</p>
                </div>

                <div class="rounded-2xl bg-slate-50 p-6">
                    <span class="grid h-11 w-11 place-items-center rounded-xl bg-emerald-100 text-emerald-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3 4 6v6c0 5 3.4 8.3 8 9 4.6-.7 8-4 8-9V6l-8-3Zm0 5v5m0 3h.01" />
                        </svg>
                    </span>
                    <h3 class="mt-5 text-base font-semibold text-slate-900">Гарантия 2 года</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600">Официальная гарантия производителя и собственный сервисный центр.</p>
                </div>

                <div class="rounded-2xl bg-slate-50 p-6">
                    <span class="grid h-11 w-11 place-items-center rounded-xl bg-violet-100 text-violet-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 13a8 8 0 0 1 16 0M4 13v4a2 2 0 0 0 2 2h1v-6H6a2 2 0 0 0-2 2Zm16 0v4a2 2 0 0 1-2 2h-1v-6h1a2 2 0 0 1 2 2Z" />
                        </svg>
                    </span>
                    <h3 class="mt-5 text-base font-semibold text-slate-900">Живая поддержка</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600">Отвечаем в чате и по телефону 24/7. Поможем выбрать и настроить.</p>
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
                    Создайте аккаунт, чтобы сохранять избранное, следить за заказами и получать персональные предложения.
                </p>
                <div class="mt-8 flex flex-wrap justify-center gap-3">
                    <a href="{{ route('register') }}" class="btn bg-white text-slate-900 shadow-lg shadow-white/10 transition hover:-translate-y-0.5 hover:bg-slate-100">
                        Создать аккаунт
                    </a>
                    <a href="{{ route('catalog') }}" class="btn inline-flex border border-white/20 text-white transition hover:border-white/40 hover:bg-white/5">
                        Перейти в каталог
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
