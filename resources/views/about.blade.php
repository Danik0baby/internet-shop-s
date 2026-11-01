@extends('layouts.app')

@section('title', 'О нас — NOVA')
@section('meta_description', 'NOVA — команда, которая делает технологии понятными. Наша история, принципы и подход к выбору техники.')

@section('content')
    <section class="relative overflow-hidden">
        <div class="pointer-events-none absolute -right-32 -top-24 h-96 w-96 rounded-full bg-indigo-200/40 blur-3xl"></div>

        <div class="container-page grid items-center gap-14 py-16 lg:grid-cols-[1.2fr_1fr] lg:py-24">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full border border-indigo-100 bg-indigo-50 px-4 py-1.5 text-xs font-semibold text-indigo-700">
                    <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                    О компании
                </span>

                <h1 class="mt-6 text-4xl font-bold leading-[1.08] tracking-tight text-slate-900 sm:text-5xl">
                    Технологии должны быть
                    <span class="bg-gradient-to-r from-indigo-600 via-violet-600 to-fuchsia-600 bg-clip-text text-transparent">понятными</span>
                </h1>

                <p class="mt-6 max-w-xl text-base leading-7 text-slate-600 sm:text-lg">
                    NOVA — это магазин, в котором не нужно разбираться в сотнях характеристик. Мы отбираем технику, объясняем разницу простыми словами и остаёмся рядом после покупки.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('catalog') }}" class="btn-primary">Посмотреть каталог</a>
                    <a href="{{ route('register') }}" class="btn-secondary">Создать аккаунт</a>
                </div>
            </div>

            <div class="relative mx-auto w-full max-w-md">
                <div class="relative overflow-hidden rounded-[2rem] bg-slate-900 p-8 text-white shadow-glow sm:p-10">
                    <div class="absolute -right-16 -top-16 h-56 w-56 rounded-full bg-indigo-500/30 blur-3xl"></div>
                    <div class="absolute -bottom-20 -left-10 h-56 w-56 rounded-full bg-fuchsia-500/20 blur-3xl"></div>

                    <div class="relative">
                        <span class="grid h-14 w-14 place-items-center rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-500 text-xl font-bold">N</span>
                        <p class="mt-10 text-5xl font-bold tracking-tight">2018</p>
                        <p class="mt-2 text-sm text-slate-400">год основания NOVA</p>

                        <div class="mt-10 grid grid-cols-2 gap-6 border-t border-white/10 pt-8">
                            <div>
                                <p class="text-2xl font-bold">40+</p>
                                <p class="mt-1 text-xs text-slate-400">брендов в каталоге</p>
                            </div>
                            <div>
                                <p class="text-2xl font-bold">98%</p>
                                <p class="mt-1 text-xs text-slate-400">заказов вовремя</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container-page">
        <dl class="grid gap-4 rounded-3xl border border-slate-200 bg-white p-6 sm:grid-cols-2 sm:p-8 lg:grid-cols-4">
            <div class="rounded-2xl bg-slate-50 p-5">
                <dt class="text-xs font-medium text-slate-500">Клиентов</dt>
                <dd class="mt-2 text-3xl font-bold tracking-tight text-slate-900">12 000+</dd>
            </div>
            <div class="rounded-2xl bg-slate-50 p-5">
                <dt class="text-xs font-medium text-slate-500">Лет на рынке</dt>
                <dd class="mt-2 text-3xl font-bold tracking-tight text-slate-900">8</dd>
            </div>
            <div class="rounded-2xl bg-slate-50 p-5">
                <dt class="text-xs font-medium text-slate-500">Средний рейтинг</dt>
                <dd class="mt-2 text-3xl font-bold tracking-tight text-slate-900">4.9</dd>
            </div>
            <div class="rounded-2xl bg-slate-50 p-5">
                <dt class="text-xs font-medium text-slate-500">Поддержка</dt>
                <dd class="mt-2 text-3xl font-bold tracking-tight text-slate-900">24/7</dd>
            </div>
        </dl>
    </section>

    <section class="container-page py-20">
        <div class="grid gap-12 lg:grid-cols-2 lg:items-center">
            <div class="rounded-[2rem] bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-600 p-8 text-white sm:p-10">
                <p class="text-sm font-medium uppercase tracking-[0.2em] text-white/70">Наша миссия</p>
                <p class="mt-6 text-2xl font-semibold leading-snug sm:text-3xl">
                    «Хорошая техника не должна требовать инструкции на сорок страниц».
                </p>
                <p class="mt-6 text-sm leading-6 text-white/80">
                    Мы верим, что покупка должна приносить радость, а не головную боль. Поэтому проверяем каждое устройство и говорим о нём честно.
                </p>
                <div class="mt-10 flex items-center gap-3 border-t border-white/20 pt-6">
                    <span class="grid h-10 w-10 place-items-center rounded-full bg-white/15 text-sm font-bold">А</span>
                    <div>
                        <p class="text-sm font-semibold">Алексей Морозов</p>
                        <p class="text-xs text-white/70">Основатель NOVA</p>
                    </div>
                </div>
            </div>

            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-indigo-600">История</p>
                <h2 class="mt-3 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Начали с одного склада</h2>
                <div class="mt-5 space-y-4 text-base leading-7 text-slate-600">
                    <p>
                        В 2018 году мы открыли небольшой магазин с двумя десятками позиций. Главным правилом было простое: продавать только то, чем пользуемся сами.
                    </p>
                    <p>
                        Сегодня в каталоге больше 40 брендов, собственный сервисный центр и команда, которая отвечает на вопросы без скриптов. Но правило осталось тем же.
                    </p>
                </div>

                <ul class="mt-8 space-y-3">
                    @foreach (['Проверяем каждую партию перед отправкой', 'Даём честную гарантию 2 года', 'Помогаем настроить устройство после покупки'] as $item)
                        <li class="flex items-start gap-3 text-sm font-medium text-slate-700">
                            <span class="mt-0.5 grid h-5 w-5 shrink-0 place-items-center rounded-full bg-emerald-100 text-emerald-600">
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
                <p class="mt-2 text-sm leading-6 text-slate-600">Без скрытых комиссий и накруток. Если цена изменилась — объясняем почему.</p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-7">
                <span class="grid h-12 w-12 place-items-center rounded-2xl bg-emerald-100 text-emerald-600">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3 4 6v6c0 5 3.4 8.3 8 9 4.6-.7 8-4 8-9V6l-8-3Zm0 5v5m0 3h.01" />
                    </svg>
                </span>
                <h3 class="mt-6 text-lg font-semibold text-slate-900">Проверенное качество</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">Работаем только с официальными поставщиками и проверяем каждую партию.</p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-7">
                <span class="grid h-12 w-12 place-items-center rounded-2xl bg-violet-100 text-violet-600">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 13a8 8 0 0 1 16 0M4 13v4a2 2 0 0 0 2 2h1v-6H6a2 2 0 0 0-2 2Zm16 0v4a2 2 0 0 1-2 2h-1v-6h1a2 2 0 0 1 2 2Z" />
                    </svg>
                </span>
                <h3 class="mt-6 text-lg font-semibold text-slate-900">Забота после покупки</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">Настраиваем, консультируем и решаем вопросы, даже когда гарантия уже закончилась.</p>
            </div>
        </div>
    </section>

    <section class="container-page py-20">
        <div class="rounded-[2rem] bg-slate-900 px-8 py-14 text-center sm:px-12">
            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Давайте знакомиться</h2>
            <p class="mx-auto mt-4 max-w-xl text-base leading-7 text-slate-300">
                Загляните в каталог или задайте вопрос — мы всегда на связи.
            </p>
            <div class="mt-8 flex flex-wrap justify-center gap-3">
                <a href="{{ route('catalog') }}" class="btn bg-white text-slate-900 transition hover:-translate-y-0.5 hover:bg-slate-100">Открыть каталог</a>
                <a href="mailto:hello@nova.store" class="btn border border-white/20 text-white transition hover:border-white/40 hover:bg-white/5">Написать нам</a>
            </div>
        </div>
    </section>
@endsection
