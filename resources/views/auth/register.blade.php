@extends('layouts.app')

@section('title', 'Регистрация — NOVA')
@section('meta_description', 'Создайте аккаунт NOVA: избранное, история заказов и персональные предложения.')

@section('content')
    <section class="container-page py-12 sm:py-16">
        <div class="mx-auto grid max-w-6xl overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-xl shadow-slate-900/5 lg:grid-cols-[1fr_1.05fr]">
            <aside class="relative hidden overflow-hidden bg-slate-900 p-10 text-white lg:flex lg:flex-col lg:justify-between">
                <div class="pointer-events-none absolute -right-20 -top-20 h-64 w-64 rounded-full bg-indigo-500/30 blur-3xl"></div>
                <div class="pointer-events-none absolute -bottom-24 -left-16 h-72 w-72 rounded-full bg-fuchsia-500/20 blur-3xl"></div>

                <div class="relative">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                        <span class="grid h-9 w-9 place-items-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-500 text-sm font-bold text-white">N</span>
                        <span class="flex flex-col leading-none">
                            <span class="text-base font-bold tracking-tight text-white">NOVA</span>
                            <span class="text-[10px] font-medium uppercase tracking-[0.2em] text-slate-500">store</span>
                        </span>
                    </a>

                    <h2 class="mt-14 text-3xl font-bold leading-tight tracking-tight">
                        Создайте аккаунт и получите больше
                    </h2>
                    <p class="mt-4 text-sm leading-6 text-slate-300">
                        Это займёт меньше минуты. Всё остальное — приятные мелочи, которые делают покупки удобнее.
                    </p>

                    <ul class="mt-10 space-y-4">
                        @foreach ([
                            'Сохранение избранного и истории заказов',
                            'Персональные скидки и ранний доступ к новинкам',
                            'Быстрое оформление покупок в один клик',
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
                    <div class="flex items-center gap-1 text-amber-400" aria-label="Рейтинг 4.9 из 5">
                        @for ($star = 0; $star < 5; $star++)
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M10 15.3 4.1 18.4l1.1-6.6L.5 7.1l6.7-1L10 0l2.8 6.1 6.7 1-4.7 4.7 1.1 6.6z" />
                            </svg>
                        @endfor
                        <span class="ml-2 text-xs font-semibold text-white">4.9</span>
                    </div>
                    <p class="mt-3 text-sm leading-6 text-slate-300">
                        «Заказывал наушники — привезли на следующий день и помогли настроить. Приятно, когда о тебе думают».
                    </p>
                    <p class="mt-3 text-xs font-medium text-slate-400">Дмитрий, Москва</p>
                </div>
            </aside>

            <div class="p-6 sm:p-10 lg:p-12">
                <nav class="flex items-center gap-2 text-xs font-medium text-slate-500" aria-label="Хлебные крошки">
                    <a href="{{ route('home') }}" class="transition hover:text-slate-900">Главная</a>
                    <span aria-hidden="true">/</span>
                    <span class="text-slate-900">Регистрация</span>
                </nav>

                <h1 class="mt-6 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Регистрация</h1>
                <p class="mt-3 text-sm leading-6 text-slate-500">
                    Заполните форму — и мы сохраним ваши данные, чтобы покупки проходили быстрее.
                </p>

                @if ($errors->any())
                    <div class="mt-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700">
                        Проверьте, пожалуйста, поля формы.
                    </div>
                @endif

                <form method="POST" action="{{ route('register.store') }}" class="mt-8 space-y-5" novalidate>
                    @csrf

                    <div>
                        <label for="name" class="field-label">Имя</label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            autocomplete="name"
                            required
                            autofocus
                            placeholder="Как к вам обращаться"
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
                            value="{{ old('email') }}"
                            autocomplete="email"
                            required
                            placeholder="you@example.com"
                            class="field-input @error('email') border-rose-400 focus:border-rose-500 focus:ring-rose-500/15 @enderror"
                        >
                        @error('email')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="password" class="field-label">Пароль</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="new-password"
                                required
                                minlength="8"
                                placeholder="Минимум 8 символов"
                                class="field-input @error('password') border-rose-400 focus:border-rose-500 focus:ring-rose-500/15 @enderror"
                            >
                            @error('password')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="field-label">Повторите пароль</label>
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                autocomplete="new-password"
                                required
                                minlength="8"
                                placeholder="Ещё раз"
                                class="field-input"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="terms" class="flex cursor-pointer items-start gap-3 text-sm text-slate-600">
                            <input
                                id="terms"
                                name="terms"
                                type="checkbox"
                                value="1"
                                @checked(old('terms'))
                                required
                                class="mt-0.5 h-4 w-4 shrink-0 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                            >
                            <span>
                                Я согласен с правилами магазина и обработкой персональных данных.
                            </span>
                        </label>
                        @error('terms')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-primary w-full">
                        Создать аккаунт
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                        </svg>
                    </button>

                    <p class="text-center text-xs leading-5 text-slate-400">
                        Регистрируясь, вы соглашаетесь получать сервисные уведомления о заказах.
                    </p>
                </form>
            </div>
        </div>
    </section>
@endsection
