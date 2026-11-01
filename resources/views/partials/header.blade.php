@php
    $navigation = [
        ['label' => 'Главная', 'route' => 'home'],
        ['label' => 'Каталог', 'route' => 'catalog'],
        ['label' => 'О нас', 'route' => 'about'],
    ];
@endphp

<header class="sticky top-0 z-50 border-b border-slate-200/70 bg-white/85 backdrop-blur-xl">
    <div class="container-page flex h-16 items-center justify-between gap-3">
        <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-2.5">
            <span class="grid h-9 w-9 place-items-center rounded-xl bg-gradient-to-br from-indigo-600 to-violet-600 text-sm font-bold text-white shadow-lg shadow-indigo-600/25">
                N
            </span>
            <span class="flex flex-col leading-none">
                <span class="text-base font-bold tracking-tight">NOVA</span>
                <span class="text-[10px] font-medium uppercase tracking-[0.2em] text-slate-400">store</span>
            </span>
        </a>

        <nav class="hidden items-center gap-1 lg:flex" aria-label="Основная навигация">
            @foreach ($navigation as $item)
                <a
                    href="{{ route($item['route']) }}"
                    class="nav-link {{ request()->routeIs($item['route']) ? 'nav-link-active' : '' }}"
                    @if (request()->routeIs($item['route'])) aria-current="page" @endif
                >
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="flex items-center gap-2">
            <button
                type="button"
                class="relative grid h-10 w-10 place-items-center rounded-full text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
                aria-label="Корзина"
            >
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13 5.4 5M7 13l-2.3 4.6a1 1 0 0 0 .9 1.4H17M9 20a1 1 0 1 0 2 0 1 1 0 0 0-2 0Zm7 0a1 1 0 1 0 2 0 1 1 0 0 0-2 0Z" />
                </svg>
                <span data-cart-count class="absolute -right-0.5 -top-0.5 hidden min-w-5 rounded-full bg-indigo-600 px-1.5 py-0.5 text-center text-[10px] font-bold leading-4 text-white">0</span>
            </button>

            @auth
                <div class="hidden items-center gap-2 sm:flex">
                    <span class="grid h-9 w-9 place-items-center rounded-full bg-slate-900 text-xs font-semibold text-white">
                        {{ mb_substr(auth()->user()->name, 0, 1) }}
                    </span>
                    <span class="hidden max-w-32 truncate text-sm font-medium text-slate-700 xl:block">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link">Выйти</button>
                    </form>
                </div>
            @else
                <a href="{{ route('register') }}" class="btn-primary hidden sm:inline-flex">Регистрация</a>
            @endauth

            <button
                type="button"
                data-menu-toggle
                class="grid h-10 w-10 place-items-center rounded-full text-slate-700 transition hover:bg-slate-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 lg:hidden"
                aria-controls="mobile-menu"
                aria-expanded="false"
                aria-label="Открыть меню"
            >
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" />
                </svg>
            </button>
        </div>
    </div>

    <div id="mobile-menu" data-mobile-menu class="hidden border-t border-slate-200 bg-white lg:hidden">
        <nav class="container-page flex flex-col gap-1 py-4" aria-label="Мобильная навигация">
            @foreach ($navigation as $item)
                <a
                    href="{{ route($item['route']) }}"
                    class="rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs($item['route']) ? 'bg-slate-900 text-white' : 'text-slate-700 hover:bg-slate-100' }}"
                >
                    {{ $item['label'] }}
                </a>
            @endforeach

            <div class="mt-2 border-t border-slate-100 pt-4">
                @auth
                    <div class="flex items-center justify-between gap-3 px-4 pb-4">
                        <div class="flex items-center gap-3">
                            <span class="grid h-9 w-9 place-items-center rounded-full bg-slate-900 text-xs font-semibold text-white">
                                {{ mb_substr(auth()->user()->name, 0, 1) }}
                            </span>
                            <span class="text-sm font-medium text-slate-700">{{ auth()->user()->name }}</span>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500">Выйти</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('register') }}" class="btn-primary w-full">Создать аккаунт</a>
                @endauth
            </div>
        </nav>
    </div>
</header>
