@extends('layouts.app')

@section('title', 'Оформление заказа — '.config('shop.name', 'NOVA'))

@section('content')
    <section class="container-page pt-10 sm:pt-14">
        <nav class="flex items-center gap-2 text-xs font-medium text-slate-500" aria-label="Хлебные крошки">
            <a href="{{ route('home') }}" class="transition hover:text-slate-900">Главная</a>
            <span aria-hidden="true">/</span>
            <a href="{{ route('cart.index') }}" class="transition hover:text-slate-900">Корзина</a>
            <span aria-hidden="true">/</span>
            <span class="text-slate-900">Оформление</span>
        </nav>

        <h1 class="mt-6 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">Оформление заказа</h1>
        <p class="mt-4 max-w-2xl text-base leading-7 text-slate-600">
            Заполните контактные данные и выберите удобный способ доставки и оплаты.
        </p>
    </section>

    <section class="container-page pb-20 pt-10">
        <form method="POST" action="{{ route('checkout.store') }}" class="grid gap-8 lg:grid-cols-[1fr_360px] lg:items-start">
            @csrf

            <div class="space-y-8">
                @if ($errors->any())
                    <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700">
                        Проверьте, пожалуйста, поля формы.
                    </div>
                @endif

                <div class="rounded-3xl border border-slate-200 bg-white p-6 sm:p-8">
                    <h2 class="text-lg font-semibold text-slate-900">Получатель</h2>

                    <div class="mt-6 grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="customer_name" class="field-label">Имя и фамилия</label>
                            <input
                                id="customer_name"
                                name="customer_name"
                                type="text"
                                value="{{ old('customer_name', auth()->user()->name) }}"
                                autocomplete="name"
                                required
                                class="field-input @error('customer_name') border-rose-400 focus:border-rose-500 focus:ring-rose-500/15 @enderror"
                            >
                            @error('customer_name')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="field-label">Телефон</label>
                            <input
                                id="phone"
                                name="phone"
                                type="tel"
                                value="{{ old('phone') }}"
                                autocomplete="tel"
                                required
                                placeholder="+7 (___) ___-__-__"
                                class="field-input @error('phone') border-rose-400 focus:border-rose-500 focus:ring-rose-500/15 @enderror"
                            >
                            @error('phone')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="email" class="field-label">Электронная почта</label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email', auth()->user()->email) }}"
                                autocomplete="email"
                                required
                                class="field-input @error('email') border-rose-400 focus:border-rose-500 focus:ring-rose-500/15 @enderror"
                            >
                            @error('email')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 sm:p-8">
                    <h2 class="text-lg font-semibold text-slate-900">Доставка</h2>

                    <div class="mt-6 grid gap-3 sm:grid-cols-2">
                        <label class="flex cursor-pointer items-start gap-3 rounded-2xl border border-slate-200 p-4 transition hover:border-indigo-300">
                            <input type="radio" name="delivery_method" value="courier" @checked(old('delivery_method', 'courier') === 'courier') required class="mt-1 h-4 w-4 text-indigo-600 focus:ring-indigo-500">
                            <span>
                                <span class="block text-sm font-semibold text-slate-900">Курьером</span>
                                <span class="mt-1 block text-xs leading-5 text-slate-500">Доставка по адресу</span>
                            </span>
                        </label>

                        <label class="flex cursor-pointer items-start gap-3 rounded-2xl border border-slate-200 p-4 transition hover:border-indigo-300">
                            <input type="radio" name="delivery_method" value="pickup" @checked(old('delivery_method') === 'pickup') class="mt-1 h-4 w-4 text-indigo-600 focus:ring-indigo-500">
                            <span>
                                <span class="block text-sm font-semibold text-slate-900">Самовывоз</span>
                                <span class="mt-1 block text-xs leading-5 text-slate-500">Заберёте из магазина</span>
                            </span>
                        </label>
                    </div>
                    @error('delivery_method')
                        <p class="field-error">{{ $message }}</p>
                    @enderror

                    <div class="mt-6 grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="city" class="field-label">Город</label>
                            <input
                                id="city"
                                name="city"
                                type="text"
                                value="{{ old('city') }}"
                                autocomplete="address-level2"
                                required
                                class="field-input @error('city') border-rose-400 focus:border-rose-500 focus:ring-rose-500/15 @enderror"
                            >
                            @error('city')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="address" class="field-label">Адрес</label>
                            <input
                                id="address"
                                name="address"
                                type="text"
                                value="{{ old('address') }}"
                                autocomplete="street-address"
                                required
                                placeholder="Улица, дом, квартира"
                                class="field-input @error('address') border-rose-400 focus:border-rose-500 focus:ring-rose-500/15 @enderror"
                            >
                            @error('address')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="comment" class="field-label">Комментарий к заказу <span class="font-normal text-slate-400">(необязательно)</span></label>
                            <textarea
                                id="comment"
                                name="comment"
                                rows="3"
                                class="field-input @error('comment') border-rose-400 focus:border-rose-500 focus:ring-rose-500/15 @enderror"
                            >{{ old('comment') }}</textarea>
                            @error('comment')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 sm:p-8">
                    <h2 class="text-lg font-semibold text-slate-900">Оплата</h2>

                    <div class="mt-6 grid gap-3 sm:grid-cols-2">
                        <label class="flex cursor-pointer items-start gap-3 rounded-2xl border border-slate-200 p-4 transition hover:border-indigo-300">
                            <input type="radio" name="payment_method" value="cash" @checked(old('payment_method', 'cash') === 'cash') required class="mt-1 h-4 w-4 text-indigo-600 focus:ring-indigo-500">
                            <span>
                                <span class="block text-sm font-semibold text-slate-900">При получении</span>
                                <span class="mt-1 block text-xs leading-5 text-slate-500">Наличными или картой курьеру</span>
                            </span>
                        </label>

                        <label class="flex cursor-pointer items-start gap-3 rounded-2xl border border-slate-200 p-4 transition hover:border-indigo-300">
                            <input type="radio" name="payment_method" value="card" @checked(old('payment_method') === 'card') class="mt-1 h-4 w-4 text-indigo-600 focus:ring-indigo-500">
                            <span>
                                <span class="block text-sm font-semibold text-slate-900">Картой онлайн</span>
                                <span class="mt-1 block text-xs leading-5 text-slate-500">Ссылка на оплату придёт после оформления</span>
                            </span>
                        </label>
                    </div>
                    @error('payment_method')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <aside class="rounded-3xl border border-slate-200 bg-white p-6 lg:sticky lg:top-24">
                <h2 class="text-lg font-semibold text-slate-900">Ваш заказ</h2>

                <ul class="mt-5 space-y-3">
                    @foreach ($items as $item)
                        <li class="flex items-start justify-between gap-3 text-sm">
                            <span class="min-w-0">
                                <a href="{{ route('catalog.show', $item['product']) }}" class="block truncate font-medium text-slate-900 transition hover:text-indigo-600">
                                    {{ $item['product']->name }}
                                </a>
                                <span class="text-xs text-slate-500">{{ $item['quantity'] }} × {{ $item['product']->formatted_price }}</span>
                            </span>
                            <span class="shrink-0 font-semibold text-slate-900">{{ number_format($item['total'] / 100, 0, '.', ' ') }} ₽</span>
                        </li>
                    @endforeach
                </ul>

                <dl class="mt-5 space-y-3 border-t border-slate-200 pt-4 text-sm">
                    <div class="flex items-center justify-between gap-3">
                        <dt class="text-slate-500">Товары</dt>
                        <dd class="font-medium text-slate-900">{{ number_format($subtotal / 100, 0, '.', ' ') }} ₽</dd>
                    </div>
                    <div class="flex items-center justify-between gap-3">
                        <dt class="text-slate-500">Доставка</dt>
                        <dd class="text-slate-500">при подтверждении</dd>
                    </div>
                    <div class="flex items-center justify-between gap-3 border-t border-slate-200 pt-3">
                        <dt class="text-base font-semibold text-slate-900">К оплате</dt>
                        <dd class="text-xl font-bold text-slate-900">{{ number_format($subtotal / 100, 0, '.', ' ') }} ₽</dd>
                    </div>
                </dl>

                <button type="submit" class="btn-primary mt-6 w-full">Подтвердить заказ</button>
                <a href="{{ route('cart.index') }}" class="btn-secondary mt-3 w-full">Вернуться в корзину</a>
            </aside>
        </form>
    </section>
@endsection
