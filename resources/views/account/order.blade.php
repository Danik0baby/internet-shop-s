@extends('layouts.app')

@section('title', 'Заказ '.$order->number.' — '.config('shop.name', 'NOVA'))

@section('content')
    @php
        $delivery = match ($order->delivery_method) {
            'pickup' => 'Самовывоз',
            default => 'Курьером',
        };
        $payment = match ($order->payment_method) {
            'card' => 'Картой онлайн',
            default => 'При получении',
        };
    @endphp

    <section class="container-page pt-10 sm:pt-14">
        <nav class="flex flex-wrap items-center gap-2 text-xs font-medium text-slate-500" aria-label="Хлебные крошки">
            <a href="{{ route('home') }}" class="transition hover:text-slate-900">Главная</a>
            <span aria-hidden="true">/</span>
            <a href="{{ route('account') }}" class="transition hover:text-slate-900">Личный кабинет</a>
            <span aria-hidden="true">/</span>
            <span class="text-slate-900">{{ $order->number }}</span>
        </nav>

        <div class="mt-6 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Заказ {{ $order->number }}</h1>
                <p class="mt-2 text-sm text-slate-500">Оформлен {{ $order->created_at->format('d.m.Y в H:i') }}</p>
            </div>
            <span class="rounded-full bg-slate-100 px-4 py-2 text-xs font-semibold text-slate-700">
                {{ $order->status->label() }}
            </span>
        </div>
    </section>

    <section class="container-page pb-20 pt-10">
        <div class="grid gap-8 lg:grid-cols-[1fr_360px] lg:items-start">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 sm:p-8">
                <h2 class="text-lg font-semibold text-slate-900">Товары</h2>

                <ul class="mt-6 divide-y divide-slate-100">
                    @foreach ($order->items as $item)
                        <li class="flex items-start justify-between gap-4 py-4">
                            <div class="min-w-0">
                                @if ($item->product)
                                    <a href="{{ route('catalog.show', $item->product) }}" class="block truncate text-sm font-medium text-slate-900 transition hover:text-indigo-600">
                                        {{ $item->product_name }}
                                    </a>
                                @else
                                    <span class="block truncate text-sm font-medium text-slate-900">{{ $item->product_name }}</span>
                                @endif
                                <p class="mt-1 text-xs text-slate-500">{{ $item->quantity }} × {{ number_format($item->price / 100, 0, '.', ' ') }} ₽</p>
                            </div>
                            <p class="shrink-0 text-sm font-semibold text-slate-900">{{ $item->formatted_line_total }}</p>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-4 flex items-center justify-between gap-3 border-t border-slate-200 pt-4">
                    <span class="text-base font-semibold text-slate-900">Итого</span>
                    <span class="text-xl font-bold text-slate-900">{{ $order->formatted_total }}</span>
                </div>
            </div>

            <aside class="space-y-4">
                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-sm font-semibold text-slate-900">Получатель</h2>
                    <dl class="mt-3 space-y-2 text-sm text-slate-600">
                        <div class="flex justify-between gap-3">
                            <dt class="text-slate-500">Имя</dt>
                            <dd class="text-right">{{ $order->customer_name }}</dd>
                        </div>
                        <div class="flex justify-between gap-3">
                            <dt class="text-slate-500">Телефон</dt>
                            <dd class="text-right">{{ $order->phone }}</dd>
                        </div>
                        <div class="flex justify-between gap-3">
                            <dt class="text-slate-500">Почта</dt>
                            <dd class="break-all text-right">{{ $order->email }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-sm font-semibold text-slate-900">Доставка и оплата</h2>
                    <dl class="mt-3 space-y-2 text-sm text-slate-600">
                        <div class="flex justify-between gap-3">
                            <dt class="text-slate-500">Способ</dt>
                            <dd class="text-right">{{ $delivery }}</dd>
                        </div>
                        <div class="flex justify-between gap-3">
                            <dt class="text-slate-500">Оплата</dt>
                            <dd class="text-right">{{ $payment }}</dd>
                        </div>
                        <div class="flex justify-between gap-3">
                            <dt class="text-slate-500">Адрес</dt>
                            <dd class="text-right">{{ $order->city }}, {{ $order->address }}</dd>
                        </div>
                    </dl>
                </div>

                @if ($order->comment)
                    <div class="rounded-3xl border border-slate-200 bg-white p-6">
                        <h2 class="text-sm font-semibold text-slate-900">Комментарий</h2>
                        <p class="mt-2 text-sm leading-6 text-slate-600">{{ $order->comment }}</p>
                    </div>
                @endif
            </aside>
        </div>

        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ route('account') }}" class="btn-secondary">← Мои заказы</a>
            <a href="{{ route('catalog') }}" class="btn-secondary">В каталог</a>
        </div>
    </section>
@endsection
