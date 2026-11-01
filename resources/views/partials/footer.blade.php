@php
    $footerCategories = collect(config('catalog.categories'))->take(4);
@endphp

<footer class="mt-24 bg-slate-950 text-slate-300">
    <div class="container-page py-16">
        <div class="grid gap-12 lg:grid-cols-[1.4fr_1fr_1fr_1.2fr]">
            <div>
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <span class="grid h-9 w-9 place-items-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-500 text-sm font-bold text-white">N</span>
                    <span class="flex flex-col leading-none">
                        <span class="text-base font-bold tracking-tight text-white">NOVA</span>
                        <span class="text-[10px] font-medium uppercase tracking-[0.2em] text-slate-500">store</span>
                    </span>
                </a>
                <p class="mt-5 max-w-xs text-sm leading-6 text-slate-400">
                    Техника, которая упрощает жизнь. Подбираем понятные устройства и поддерживаем после покупки.
                </p>
                <div class="mt-6 flex items-center gap-3">
                    <a href="https://t.me/" target="_blank" rel="noopener noreferrer" class="grid h-10 w-10 place-items-center rounded-full bg-white/5 text-slate-300 transition hover:bg-white/10 hover:text-white" aria-label="Telegram">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M21.9 4.3 18.6 20c-.2 1.1-.9 1.4-1.8.9l-5-3.7-2.4 2.3c-.3.3-.5.5-1 .5l.4-5 9.2-8.3c.4-.4-.1-.6-.6-.2L6.9 13.4 2 12c-1.1-.3-1.1-1.1.2-1.6l18.4-7.1c.9-.3 1.7.2 1.3 1Z" />
                        </svg>
                    </a>
                    <a href="https://vk.com/" target="_blank" rel="noopener noreferrer" class="grid h-10 w-10 place-items-center rounded-full bg-white/5 text-slate-300 transition hover:bg-white/10 hover:text-white" aria-label="ВКонтакте">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M13.2 18.4c-5.9 0-9.3-4-9.4-10.7h3c.1 4.9 2.3 7 4 7.4V7.7h2.8v4.2c1.7-.2 3.4-2.1 4-4.2h2.8a8.3 8.3 0 0 1-3.8 5.4 8.6 8.6 0 0 1 4.4 5.3h-3.1a5.4 5.4 0 0 0-4.3-3.8v3.8h-1.4Z" />
                        </svg>
                    </a>
                    <a href="https://youtube.com/" target="_blank" rel="noopener noreferrer" class="grid h-10 w-10 place-items-center rounded-full bg-white/5 text-slate-300 transition hover:bg-white/10 hover:text-white" aria-label="YouTube">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M23 12s0-3.4-.4-5a2.6 2.6 0 0 0-1.8-1.8C19.2 4.8 12 4.8 12 4.8s-7.2 0-8.8.4A2.6 2.6 0 0 0 1.4 7C1 8.6 1 12 1 12s0 3.4.4 5a2.6 2.6 0 0 0 1.8 1.8c1.6.4 8.8.4 8.8.4s7.2 0 8.8-.4a2.6 2.6 0 0 0 1.8-1.8c.4-1.6.4-5 .4-5Zm-13.3 3.2V8.8l5.8 3.2-5.8 3.2Z" />
                        </svg>
                    </a>
                </div>
            </div>

            <div>
                <h2 class="text-sm font-semibold text-white">Каталог</h2>
                <ul class="mt-5 space-y-3 text-sm">
                    @foreach ($footerCategories as $category)
                        <li>
                            <a href="{{ route('catalog') }}" class="text-slate-400 transition hover:text-white">{{ $category['label'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h2 class="text-sm font-semibold text-white">Компания</h2>
                <ul class="mt-5 space-y-3 text-sm">
                    <li><a href="{{ route('about') }}" class="text-slate-400 transition hover:text-white">О нас</a></li>
                    <li><a href="{{ route('catalog') }}" class="text-slate-400 transition hover:text-white">Каталог</a></li>
                    <li><a href="{{ route('register') }}" class="text-slate-400 transition hover:text-white">Регистрация</a></li>
                    <li><a href="{{ route('home') }}#delivery" class="text-slate-400 transition hover:text-white">Доставка и оплата</a></li>
                </ul>
            </div>

            <div>
                <h2 class="text-sm font-semibold text-white">Контакты</h2>
                <ul class="mt-5 space-y-3 text-sm text-slate-400">
                    <li>
                        <a href="tel:+78005550123" class="transition hover:text-white">+7 (800) 555-01-23</a>
                    </li>
                    <li>
                        <a href="mailto:hello@nova.store" class="transition hover:text-white">hello@nova.store</a>
                    </li>
                    <li>Москва, ул. Технологическая, 12</li>
                    <li>Ежедневно с 10:00 до 21:00</li>
                </ul>
            </div>
        </div>

        <div class="mt-14 flex flex-col gap-4 border-t border-white/10 pt-8 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between">
            <p>© {{ now()->year }} NOVA store. Все права защищены.</p>
            <p>Сделано с вниманием к деталям.</p>
        </div>
    </div>
</footer>
