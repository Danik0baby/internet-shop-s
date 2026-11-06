@extends('layouts.app')

@section('title', 'Вход — '.config('shop.name', 'NOVA'))
@section('meta_description', 'Войдите в аккаунт, чтобы оформлять заказы и сохранять избранное.')

@section('content')
    <section class="container-page py-12 sm:py-16">
        <div class="mx-auto grid max-w-6xl overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-xl shadow-slate-900/5 lg:grid-cols-[1fr_1.05fr]">
            <aside class="relative hidden overflow-hidden bg-slate-900 p-10 text-white lg:flex lg:flex-col lg:justify-between">
                <div class="pointer-events-none absolute -right-20 -top-20 h-64 w-64 rounded-full bg-indigo-500/30 blur-3xl"></div>
                <div class="pointer-events-none absolute -bottom-24 -left-16 h-72 w-72 rounded-full bg-fuchsia-500/20 blur-3xl"></div>

                <div class="relative">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                        <span class="grid h-9 w-9 place-items-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-500 text-sm font-bold text-white">
                            {{ mb_substr(config('shop.name', 'NOVA'), 0, 1) }}
                        </span>
                        <span class="flex flex-col leading-none">
                            <span class="text-base font-bold tracking-tight text-white">{{ config('shop.name', 'NOVA') }}</span>
                            <span class="text-[10px] font-medium uppercase tracking-[0.2em] text-slate-500">store</span>
                        </span>
                    </a>

                    <h2 class="mt-14 text-3xl font-bold leading-tight tracking-tight">Рады видеть снова</h2>
                    <p class="mt-4 text-sm leading-6 text-slate-300">
                        Войдите, чтобы оформить заказ и вернуться к сохранённым товарам.
                    </p>

                    <ul class="mt-10 space-y-4">
                        @foreach ([
                            'Быстрое оформление заказов',
                            'История покупок и статусы доставки',
                            'Избранные товары в одном месте',
                        ] as $benefit)
                            <li class="flex items-start gap-3 text-sm text-slate-200">
                                <span class="mt-0.5 grid h-5 w-5 shrink-0 place-items-center rounded-full bg-emerald-500/20 text-emerald-300">
                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m5 13 4 4L19 7" />
                                    </svg>
                                </span>
                                {{ $benefit }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="relative mt-12 rounded-2xl border border-white/10 bg-white/5 p-5">
                    <h3 class="text-sm font-semibold text-white">Нет аккаунта?</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-300">
                        Создайте его за минуту — после регистрации вы сразу сможете оформлять заказы.
                    </p>
                    <a href="{{ route('register') }}" class="mt-4 inline-flex text-sm font-semibold text-indigo-300 transition hover:text-indigo-200">
                        Зарегистрироваться →
                    </a>
                </div>
            </aside>

            <div class="p-6 sm:p-10 lg:p-12">
                <nav class="flex items-center gap-2 text-xs font-medium text-slate-500" aria-label="Хлебные крошки">
                    <a href="{{ route('home') }}" class="transition hover:text-slate-900">Главная</a>
                    <span aria-hidden="true">/</span>
                    <span class="text-slate-900">Вход</span>
                </nav>

                <h1 class="mt-6 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Вход</h1>
                <p class="mt-3 text-sm leading-6 text-slate-500">
                    Введите почту и пароль, которые указали при регистрации.
                </p>

                @if ($errors->any())
                    <div class="mt-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700">
                        Проверьте, пожалуйста, поля формы.
                    </div>
                @endif

                <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="field-label">Электронная почта</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            required
                            autofocus
                            placeholder="you@example.com"
                            class="field-input @error('email') border-rose-400 focus:border-rose-500 focus:ring-rose-500/15 @enderror"
                        >
                        @error('email')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="field-label">Пароль</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            required
                            placeholder="Ваш пароль"
                            class="field-input @error('password') border-rose-400 focus:border-rose-500 focus:ring-rose-500/15 @enderror"
                        >
                        @error('password')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <label for="remember" class="flex cursor-pointer items-center gap-3 text-sm text-slate-600">
                        <input
                            id="remember"
                            name="remember"
                            type="checkbox"
                            value="1"
                            @checked(old('remember'))
                            class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                        >
                        Запомнить меня
                    </label>

                    <button type="submit" class="btn-primary w-full">
                        Войти
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                        </svg>
                    </button>

                    <p class="text-center text-xs leading-5 text-slate-400">
                        Нет аккаунта?
                        <a href="{{ route('register') }}" class="font-semibold text-indigo-600 transition hover:text-indigo-500">Зарегистрируйтесь</a>
                    </p>
                </form>
            </div>
        </div>
    </section>
@endsection
