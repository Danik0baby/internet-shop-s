@extends('layouts.app')

@section('title', 'О нас — '.config('shop.name', 'NOVA'))
@section('meta_description', 'Магазин техники: понятный выбор, честные характеристики и поддержка после покупки.')

@section('content')
    <section class="relative overflow-hidden">
        <div class="pointer-events-none absolute -right-32 -top-24 h-96 w-96 rounded-full bg-indigo-200/40 blur-3xl"></div>

        <div class="container-page grid items-center gap-14 py-16 lg:grid-cols-[1.2fr_1fr] lg:py-24">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full border border-indigo-100 bg-indigo-50 px-4 py-1.5 text-xs font-semibold text-indigo-700">
                    <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                    О магазине
                </span>

                <h1 class="mt-6 text-4xl font-bold leading-[1.08] tracking-tight text-slate-900 sm:text-5xl">
                    Техника, в которой
                    <span class="bg-gradient-to-r from-indigo-600 via-violet-600 to-fuchsia-600 bg-clip-text text-transparent">легко разобраться</span>
                </h1>

                <p class="mt-6 max-w-xl text-base leading-7 text-slate-600 sm:text-lg">
                    Мы собираем каталог устройств, которые понятно описываем и честно показываем. Без запутанных характеристик, скрытых условий и навязанных опций.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('catalog') }}" class="btn-primary">Посмотреть каталог</a>
                    <a href="{{ route('contacts') }}" class="btn-secondary">Связаться с нами</a>
                </div>
            </div>

            <div class="relative mx-auto w-full max-w-md">
                <div class="relative overflow-hidden rounded-[2rem] bg-slate-900 p-8 text-white shadow-glow sm:p-10">
                    <div class="absolute -right-16 -top-16 h-56 w-56 rounded-full bg-indigo-500/30 blur-3xl"></div>
                    <div class="absolute -bottom-20 -left-10 h-56 w-56 rounded-full bg-fuchsia-500/20 blur-3xl"></div>

                    <div class="relative">
                        <span class="grid h-14 w-14 place-items-center rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-500 text-xl font-bold">
                            {{ mb_substr(config('shop.name', 'NOVA'), 0, 1) }}
                        </span>

                        <p class="mt-10 text-2xl font-bold tracking-tight">Наш подход</p>
                        <p class="mt-3 text-sm leading-6 text-slate-300">
                            Только понятные карточки товаров, актуальные цены и поддержка, которая помогает выбрать.
                        </p>

                        <ul class="mt-8 space-y-4 border-t border-white/10 pt-8">
                            @foreach ([
                                'Проверяем ассортимент перед публикацией',
                                'Описываем характеристики простыми словами',
                                'Отвечаем на вопросы после покупки',
                            ] as $item)
                                <li class="flex items-start gap-3 text-sm text-slate-200">
                                    <span class="mt-0.5 grid h-5 w-5 shrink-0 place-items-center rounded-full bg-emerald-500/20 text-emerald-300">
                                        <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m5 13 4 4L19 7" />
                                        </svg>
                                    </span>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container-page py-16">
        <div class="grid gap-12 lg:grid-cols-2 lg:items-center">
            <div class="rounded-[2rem] bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-600 p-8 text-white sm:p-10">
                <p class="text-sm font-medium uppercase tracking-[0.2em] text-white/70">Наш принцип</p>
                <p class="mt-6 text-2xl font-semibold leading-snug sm:text-3xl">
                    «Хорошая техника не должна требовать инструкции на сорок страниц».
                </p>
                <p class="mt-6 text-sm leading-6 text-white/80">
                    Поэтому мы показываем только важное и не скрываем детали за маркетинговыми формулировками.
                </p>
            </div>

            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-indigo-600">Как мы работаем</p>
                <h2 class="mt-3 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Понятный путь от выбора до покупки</h2>
                <div class="mt-5 space-y-4 text-base leading-7 text-slate-600">
                    <p>
                        Каталог пополняется через панель управления магазином: каждая категория и карточка товара создаются ответственным сотрудником.
                    </p>
                    <p>
                        Мы следим за наличием и актуальностью цен, а после оформления заказа остаёмся на связи по вопросам доставки и гарантии.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="container-page py-10">
        <div class="max-w-2xl">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-indigo-600">Принципы</p>
            <h2 class="mt-3 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Во что мы верим</h2>
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-3">
            <div class="rounded-3xl border border-slate-200 bg-white p-7">
                <span class="grid h-12 w-12 place-items-center rounded-2xl bg-indigo-100 text-indigo-600">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m-7-9h14" />
                    </svg>
                </span>
                <h3 class="mt-6 text-lg font-semibold text-slate-900">Честные цены</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">Без скрытых комиссий и накруток. Цена в карточке — та, которую вы увидите при оформлении.</p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-7">
                <span class="grid h-12 w-12 place-items-center rounded-2xl bg-emerald-100 text-emerald-600">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3 4 6v6c0 5 3.4 8.3 8 9 4.6-.7 8-4 8-9V6l-8-3Zm0 5v5m0 3h.01" />
                    </svg>
                </span>
                <h3 class="mt-6 text-lg font-semibold text-slate-900">Понятные характеристики</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">В карточке товара — только то, что важно для выбора, без лишнего шума.</p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-7">
                <span class="grid h-12 w-12 place-items-center rounded-2xl bg-violet-100 text-violet-600">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 13a8 8 0 0 1 16 0M4 13v4a2 2 0 0 0 2 2h1v-6H6a2 2 0 0 0-2 2Zm16 0v4a2 2 0 0 1-2 2h-1v-6h1a2 2 0 0 1 2 2Z" />
                    </svg>
                </span>
                <h3 class="mt-6 text-lg font-semibold text-slate-900">Поддержка после покупки</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">Поможем с настройкой и подскажем, как обратиться по гарантии.</p>
            </div>
        </div>
    </section>

    <section class="container-page py-20">
        <div class="rounded-[2rem] bg-slate-900 px-8 py-14 text-center sm:px-12">
            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Давайте знакомиться</h2>
            <p class="mx-auto mt-4 max-w-xl text-base leading-7 text-slate-300">
                Загляните в каталог или задайте вопрос — мы на связи.
            </p>
            <div class="mt-8 flex flex-wrap justify-center gap-3">
                <a href="{{ route('catalog') }}" class="btn bg-white text-slate-900 transition hover:-translate-y-0.5 hover:bg-slate-100">Открыть каталог</a>
                <a href="{{ route('contacts') }}" class="btn border border-white/20 text-white transition hover:border-white/40 hover:bg-white/5">Написать нам</a>
            </div>
        </div>
    </section>
@endsection
