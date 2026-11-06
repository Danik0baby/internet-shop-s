@extends('layouts.app')

@section('title', 'Личный кабинет — '.config('shop.name', 'NOVA'))

@section('content')
    <section class="container-page pt-10 sm:pt-14">
        <nav class="flex items-center gap-2 text-xs font-medium text-slate-500" aria-label="Хлебные крошки">
            <a href="{{ route('home') }}" class="transition hover:text-slate-900">Главная</a>
            <span aria-hidden="true">/</span>
            <span class="text-slate-900">Личный кабинет</span>
        </nav>

        <div class="mt-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">Личный кабинет</h1>
                <p class="mt-3 text-base text-slate-600">{{ $user->email }}</p>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('favorites.index') }}" class="btn-secondary">Избранное</a>
                <a href="{{ route('cart.index') }}" class="btn-secondary">Корзина</a>
            </div>
        </div>
    </section>

    <section class="container-page pb-20 pt-10">
        <div class="grid gap-8 lg:grid-cols-[360px_1fr] lg:items-start">
            <aside class="rounded-3xl border border-slate-200 bg-white p-6 lg:sticky lg:top-24">
                <h2 class="text-lg font-semibold text-slate-900">Профиль</h2>

                @if ($errors->any())
                    <div class="mt-4 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700">
                        Проверьте, пожалуйста, поля формы.
                    </div>
                @endif

                <form method="POST" action="{{ route('account.update') }}" class="mt-5 space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="name" class="field-label">Имя</label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name', $user->name) }}"
                            autocomplete="name"
                            required
                            class="field-input @error('name') border-rose-400 focus:border-rose-500 focus:ring-rose-500/15 @enderror"
                        >
                        @error('name')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="field-label">Электронная почта</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email', $user->email) }}"
                            autocomplete="email"
                            required
                            class="field-input @error('email') border-rose-400 focus:border-rose-500 focus:ring-rose-500/15 @enderror"
                        >
                        @error('email')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-primary w-full">Сохранить</button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="mt-4 border-t border-slate-100 pt-4">
                    @csrf
                    <button type="submit" class="w-full rounded-full border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:border-rose-300 hover:text-rose-600">
                        Выйти из аккаунта
                    </button>
                </form>
            </aside>

            <div>
                <div class="flex flex-wrap items-end justify-between gap-3">
                    <h2 class="text-2xl font-bold tracking-tight text-slate-900">Мои заказы</h2>
                    <a href="{{ route('catalog') }}" class="text-sm font-semibold text-indigo-600 transition hover:text-indigo-500">В каталог →</a>
                </div>

                @if ($orders->isEmpty())
                    <div class="mt-6 rounded-3xl border border-dashed border-slate-300 bg-white p-10 text-center">
                        <span class="grid h-14 w-14 mx-auto place-items-center rounded-2xl bg-slate-100 text-slate-400">
                            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 2h9l4 4v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2Zm2 9h8M8 15h5" />
                            </svg>
                        </span>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Заказов пока нет</h3>
                        <p class="mt-2 text-sm text-slate-500">Ваши покупки появятся здесь после оформления.</p>
                        <a href="{{ route('catalog') }}" class="btn-primary mt-6">Перейти в каталог</a>
                    </div>
                @else
                    <div class="mt-6 space-y-4">
                        @foreach ($orders as $order)
                            @php
                                $statusClasses = match ($order->status) {
                                    \App\Enums\OrderStatus::New => 'bg-indigo-100 text-indigo-700',
                                    \App\Enums\OrderStatus::Processing => 'bg-amber-100 text-amber-700',
                                    \App\Enums\OrderStatus::Shipped => 'bg-sky-100 text-sky-700',
                                    \App\Enums\OrderStatus::Completed => 'bg-emerald-100 text-emerald-700',
                                    \App\Enums\OrderStatus::Cancelled => 'bg-rose-100 text-rose-700',
                                };
                            @endphp

                            <a href="{{ route('account.order', $order) }}" class="block rounded-3xl border border-slate-200 bg-white p-5 transition hover:border-indigo-200 hover:shadow-lg hover:shadow-slate-900/5 sm:p-6">
                                <div class="flex flex-wrap items-center justify-between gap-3">
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900">{{ $order->number }}</p>
                                        <p class="mt-1 text-xs text-slate-500">от {{ $order->created_at->format('d.m.Y') }}</p>
                                    </div>
                                    <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $statusClasses }}">
                                        {{ $order->status->label() }}
                                    </span>
                                </div>

                                <div class="mt-4 flex flex-wrap items-center justify-between gap-3 border-t border-slate-100 pt-4 text-sm">
                                    <span class="text-slate-500">
                                        {{ trans_choice(':count товар|:count товара|:count товаров', $order->items_count, ['count' => $order->items_count]) }}
                                    </span>
                                    <span class="font-bold text-slate-900">{{ $order->formatted_total }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
