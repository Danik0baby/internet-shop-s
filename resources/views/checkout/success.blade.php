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
        <div class="mx-auto max-w-3xl text-center">
            <span class="mx-auto grid h-16 w-16 place-items-center rounded-full bg-emerald-100 text-emerald-600">
                <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m5 13 4 4L19 7" />
                </svg>
            </span>
            <h1 class="mt-6 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Заказ оформлен</h1>
            <p class="mt-3 text-base leading-7 text-slate-600">
                Спасибо! Мы отправили детали на {{ $order->email }}. Номер заказа:
                <span class="font-semibold text-slate-900">{{ $order->number }}</span>.
            </p>
        </div>
    </section>

    <section class="container-page pb-20 pt-10">
        <div class="mx-auto max-w-3xl space-y-6">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 sm:p-8">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <h2 class="text-lg font-semibold text-slate-900">Состав заказа</h2>
                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                        {{ $order->status->label() }}
                    </span>
                </div>

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

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-sm font-semibold text-slate-900">Доставка</h2>
                    <p class="mt-2 text-sm text-slate-600">{{ $delivery }}</p>
                    <p class="mt-1 text-sm text-slate-500">{{ $order->city }}, {{ $order->address }}</p>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-sm font-semibold text-slate-900">Оплата</h2>
                    <p class="mt-2 text-sm text-slate-600">{{ $payment }}</p>
                    <p class="mt-1 text-sm text-slate-500">Получатель: {{ $order->customer_name }}</p>
                </div>
            </div>

            <div class="flex flex-wrap justify-center gap-3">
                <a href="{{ route('account') }}" class="btn-primary">Мои заказы</a>
                <a href="{{ route('catalog') }}" class="btn-secondary">Продолжить покупки</a>
            </div>
        </div>
    </section>
@endsection
