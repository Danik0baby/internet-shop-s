@php
    $shopName = config('shop.name', 'NOVA');
    $phone = config('shop.phone');
    $email = config('shop.email');
    $address = config('shop.address');
    $schedule = config('shop.schedule');
@endphp

<footer class="mt-24 bg-slate-950 text-slate-300">
    <div class="container-page py-16">
        <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-[1.4fr_1fr_1fr_1.2fr]">
            <div>
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <span class="grid h-9 w-9 place-items-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-500 text-sm font-bold text-white">
                        {{ mb_substr($shopName, 0, 1) }}
                    </span>
                    <span class="flex flex-col leading-none">
                        <span class="text-base font-bold tracking-tight text-white">{{ $shopName }}</span>
                        <span class="text-[10px] font-medium uppercase tracking-[0.2em] text-slate-500">store</span>
                    </span>
                </a>
                <p class="mt-5 max-w-xs text-sm leading-6 text-slate-400">
                    Магазин техники, которая упрощает жизнь. Каталог наполняется через панель управления магазином.
                </p>
            </div>

            <div>
                <h2 class="text-sm font-semibold text-white">Каталог</h2>
                <ul class="mt-5 space-y-3 text-sm">
                    @forelse ($footerCategories as $category)
                        <li>
                            <a href="{{ route('catalog', ['category' => $category->slug]) }}" class="text-slate-400 transition hover:text-white">
                                {{ $category->name }}
                            </a>
                        </li>
                    @empty
                        <li class="text-slate-500">Категории появятся после наполнения каталога</li>
                    @endforelse
                </ul>
            </div>

            <div>
                <h2 class="text-sm font-semibold text-white">Компания</h2>
                <ul class="mt-5 space-y-3 text-sm">
                    <li><a href="{{ route('menu') }}" class="text-slate-400 transition hover:text-white">Меню</a></li>
                    <li><a href="{{ route('catalog') }}" class="text-slate-400 transition hover:text-white">Каталог</a></li>
                    <li><a href="{{ route('about') }}" class="text-slate-400 transition hover:text-white">О нас</a></li>
                    <li><a href="{{ route('delivery') }}" class="text-slate-400 transition hover:text-white">Доставка и оплата</a></li>
                    <li><a href="{{ route('contacts') }}" class="text-slate-400 transition hover:text-white">Контакты</a></li>
                </ul>
            </div>

            <div>
                <h2 class="text-sm font-semibold text-white">Контакты</h2>
                <ul class="mt-5 space-y-3 text-sm text-slate-400">
                    @if ($phone)
                        <li><a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="transition hover:text-white">{{ $phone }}</a></li>
                    @endif
                    @if ($email)
                        <li><a href="mailto:{{ $email }}" class="transition hover:text-white">{{ $email }}</a></li>
                    @endif
                    @if ($address)
                        <li>{{ $address }}</li>
                    @endif
                    @if ($schedule)
                        <li>{{ $schedule }}</li>
                    @endif
                    <li><a href="{{ route('contacts') }}" class="font-medium text-indigo-400 transition hover:text-indigo-300">Написать нам</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-14 flex flex-col gap-4 border-t border-white/10 pt-8 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between">
            <p>© {{ now()->year }} {{ $shopName }}. Все права защищены.</p>
            <p>Сделано с вниманием к деталям.</p>
        </div>
    </div>
</footer>
