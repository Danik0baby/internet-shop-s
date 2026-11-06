@extends('layouts.app')

@section('title', 'Доставка и оплата — '.config('shop.name', 'NOVA'))
@section('meta_description', 'Способы доставки и оплаты заказов в магазине.')

@section('content')
    <section class="container-page pt-10 sm:pt-14">
        <nav class="flex items-center gap-2 text-xs font-medium text-slate-500" aria-label="Хлебные крошки">
            <a href="{{ route('home') }}" class="transition hover:text-slate-900">Главная</a>
            <span aria-hidden="true">/</span>
            <span class="text-slate-900">Доставка и оплата</span>
        </nav>

        <div class="mt-6 max-w-2xl">
            <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">Доставка и оплата</h1>
            <p class="mt-4 text-base leading-7 text-slate-600">
                Способы получения и оплаты заказа. Итоговые условия рассчитываются при оформлении.
            </p>
        </div>
    </section>

    <section class="container-page pb-20 pt-10">
        <div class="grid gap-6 lg:grid-cols-2">
            <div class="rounded-3xl border border-slate-200 bg-white p-7">
                <span class="grid h-12 w-12 place-items-center rounded-2xl bg-indigo-100 text-indigo-600">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h11v10H3zM14 10h4l3 3v4h-7zM7 21a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm10 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                    </svg>
                </span>
                <h2 class="mt-5 text-lg font-semibold text-slate-900">Курьерская доставка</h2>
                <p class="mt-2 text-sm leading-6 text-slate-600">
                    Доставим заказ по указанному адресу. Стоимость и сроки зависят от города и рассчитываются при оформлении.
                </p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-7">
                <span class="grid h-12 w-12 place-items-center rounded-2xl bg-amber-100 text-amber-600">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 21V8l8-5 8 5v13M9 21v-6h6v6" />
                    </svg>
                </span>
                <h2 class="mt-5 text-lg font-semibold text-slate-900">Самовывоз</h2>
                <p class="mt-2 text-sm leading-6 text-slate-600">
                    Заберите заказ из магазина. Адрес и часы работы указаны на странице контактов.
                </p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-7">
                <span class="grid h-12 w-12 place-items-center rounded-2xl bg-emerald-100 text-emerald-600">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M5 6h14a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2Zm2 8h4" />
                    </svg>
                </span>
                <h2 class="mt-5 text-lg font-semibold text-slate-900">Оплата при получении</h2>
                <p class="mt-2 text-sm leading-6 text-slate-600">
                    Оплатите заказ наличными или картой курьеру либо в магазине при самовывозе.
                </p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-7">
                <span class="grid h-12 w-12 place-items-center rounded-2xl bg-violet-100 text-violet-600">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16v10H4zM8 12h8M8 15h4" />
                    </svg>
                </span>
                <h2 class="mt-5 text-lg font-semibold text-slate-900">Оплата картой онлайн</h2>
                <p class="mt-2 text-sm leading-6 text-slate-600">
                    После оформления заказа мы отправим ссылку на оплату. Заказ начнём собирать после подтверждения оплаты.
                </p>
            </div>
        </div>

        <div class="mt-10 rounded-3xl border border-slate-200 bg-white p-7 sm:p-8">
            <h2 class="text-xl font-bold tracking-tight text-slate-900">Возврат и обмен</h2>
            <p class="mt-3 max-w-3xl text-sm leading-6 text-slate-600">
                Если товар не подошёл, свяжитесь с нами — поможем с обменом или возвратом в соответствии с условиями магазина и законодательством.
            </p>
            <a href="{{ route('contacts') }}" class="btn-secondary mt-6">Задать вопрос</a>
        </div>
    </section>
@endsection
