@extends('layouts.app')

@section('title', 'Контакты — '.config('shop.name', 'NOVA'))
@section('meta_description', 'Свяжитесь с магазином: телефон, почта, адрес и форма обратной связи.')

@section('content')
    @php
        $phone = config('shop.phone');
        $email = config('shop.email');
        $address = config('shop.address');
        $schedule = config('shop.schedule');
    @endphp

    <section class="container-page pt-10 sm:pt-14">
        <nav class="flex items-center gap-2 text-xs font-medium text-slate-500" aria-label="Хлебные крошки">
            <a href="{{ route('home') }}" class="transition hover:text-slate-900">Главная</a>
            <span aria-hidden="true">/</span>
            <span class="text-slate-900">Контакты</span>
        </nav>

        <div class="mt-6 max-w-2xl">
            <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">Контакты</h1>
            <p class="mt-4 text-base leading-7 text-slate-600">
                Напишите нам — поможем с выбором, заказом или возвратом.
            </p>
        </div>
    </section>

    <section class="container-page pb-20 pt-10">
        <div class="grid gap-8 lg:grid-cols-[1fr_360px] lg:items-start">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 sm:p-8">
                <h2 class="text-lg font-semibold text-slate-900">Обратная связь</h2>

                @if ($errors->any())
                    <div class="mt-4 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700">
                        Проверьте, пожалуйста, поля формы.
                    </div>
                @endif

                <form method="POST" action="{{ route('contacts.store') }}" class="mt-6 space-y-5">
                    @csrf

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="name" class="field-label">Имя</label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name', auth()->user()?->name) }}"
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
                                value="{{ old('email', auth()->user()?->email) }}"
                                autocomplete="email"
                                required
                                class="field-input @error('email') border-rose-400 focus:border-rose-500 focus:ring-rose-500/15 @enderror"
                            >
                            @error('email')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="message" class="field-label">Сообщение</label>
                        <textarea
                            id="message"
                            name="message"
                            rows="6"
                            required
                            class="field-input @error('message') border-rose-400 focus:border-rose-500 focus:ring-rose-500/15 @enderror"
                        >{{ old('message') }}</textarea>
                        @error('message')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-primary">Отправить сообщение</button>
                </form>
            </div>

            <aside class="space-y-4">
                @if ($phone || $email || $address || $schedule)
                    <div class="rounded-3xl border border-slate-200 bg-white p-6">
                        <h2 class="text-sm font-semibold text-slate-900">Реквизиты магазина</h2>
                        <ul class="mt-4 space-y-3 text-sm text-slate-600">
                            @if ($phone)
                                <li>
                                    <span class="block text-xs text-slate-400">Телефон</span>
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="font-medium text-slate-900 transition hover:text-indigo-600">{{ $phone }}</a>
                                </li>
                            @endif
                            @if ($email)
                                <li>
                                    <span class="block text-xs text-slate-400">Почта</span>
                                    <a href="mailto:{{ $email }}" class="font-medium text-slate-900 transition hover:text-indigo-600">{{ $email }}</a>
                                </li>
                            @endif
                            @if ($address)
                                <li>
                                    <span class="block text-xs text-slate-400">Адрес</span>
                                    {{ $address }}
                                </li>
                            @endif
                            @if ($schedule)
                                <li>
                                    <span class="block text-xs text-slate-400">Часы работы</span>
                                    {{ $schedule }}
                                </li>
                            @endif
                        </ul>
                    </div>
                @endif

                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-sm font-semibold text-slate-900">Как мы отвечаем</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-600">
                        Отвечаем на сообщения в порядке поступления. Для вопросов по заказу укажите его номер.
                    </p>
                </div>
            </aside>
        </div>
    </section>
@endsection
