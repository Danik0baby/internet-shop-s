@extends('layouts.app')

@section('title', 'Каталог техники — '.config('shop.name', 'NOVA'))
@section('meta_description', 'Каталог магазина: актуальные товары, категории и цены. Доставка по России.')

@section('content')
    @php
        $activeCategory = $filters['category'] ?? null;
        $activeSort = $filters['sort'] ?? 'newest';
        $search = $filters['q'] ?? null;
        $filterQuery = array_filter([
            'q' => $search,
            'sort' => $activeSort !== 'newest' ? $activeSort : null,
        ], fn ($value) => $value !== null && $value !== '');
        $hasFilters = $activeCategory !== null || $search !== null || $activeSort !== 'newest';
    @endphp

    <section class="container-page pt-10 sm:pt-14">
        <nav class="flex items-center gap-2 text-xs font-medium text-slate-500" aria-label="Хлебные крошки">
            <a href="{{ route('home') }}" class="transition hover:text-slate-900">Главная</a>
            <span aria-hidden="true">/</span>
            <span class="text-slate-900">Каталог</span>
        </nav>

        <div class="mt-6 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">Каталог</h1>
                <p class="mt-4 max-w-2xl text-base leading-7 text-slate-600">
                    Выбирайте технику по категориям, бренду или названию. Все товары добавлены через панель управления магазином.
                </p>
            </div>

            <p class="shrink-0 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-500">
                Найдено: <span class="font-semibold text-slate-900">{{ $products->total() }}</span>
            </p>
        </div>
    </section>

    <section class="container-page pb-20 pt-10">
        <form method="GET" action="{{ route('catalog') }}" class="flex flex-col gap-3 rounded-3xl border border-slate-200 bg-white p-4 sm:flex-row sm:items-center">
            @if ($activeCategory)
                <input type="hidden" name="category" value="{{ $activeCategory }}">
            @endif

            <div class="relative flex-1">
                <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.3-4.3M17 11a6 6 0 1 1-12 0 6 6 0 0 1 12 0Z" />
                    </svg>
                </span>
                <label for="q" class="sr-only">Поиск по каталогу</label>
                <input
                    id="q"
                    name="q"
                    type="search"
                    value="{{ $search }}"
                    placeholder="Поиск по названию или бренду"
                    class="field-input pl-11"
                >
            </div>

            <div class="sm:w-52">
                <label for="sort" class="sr-only">Сортировка</label>
                <select id="sort" name="sort" class="field-input">
                    <option value="newest" @selected($activeSort === 'newest')>Сначала новые</option>
                    <option value="price_asc" @selected($activeSort === 'price_asc')>Цена: по возрастанию</option>
                    <option value="price_desc" @selected($activeSort === 'price_desc')>Цена: по убыванию</option>
                    <option value="rating" @selected($activeSort === 'rating')>По рейтингу</option>
                </select>
            </div>

            <div class="flex items-center gap-2">
                <button type="submit" class="btn-primary whitespace-nowrap">Применить</button>
                @if ($hasFilters)
                    <a href="{{ route('catalog') }}" class="btn-secondary whitespace-nowrap">Сбросить</a>
                @endif
            </div>
        </form>

        <div class="mt-8 flex flex-wrap items-center gap-2" role="group" aria-label="Фильтр по категориям">
            <a
                href="{{ route('catalog', $filterQuery) }}"
                class="filter-chip"
                aria-pressed="{{ $activeCategory === null ? 'true' : 'false' }}"
            >
                Все товары
            </a>

            @foreach ($categories as $category)
                <a
                    href="{{ route('catalog', array_merge($filterQuery, ['category' => $category->slug])) }}"
                    class="filter-chip"
                    aria-pressed="{{ $activeCategory === $category->slug ? 'true' : 'false' }}"
                >
                    {{ $category->name }}
                    <span class="text-xs opacity-70">{{ $category->products_count }}</span>
                </a>
            @endforeach
        </div>

        @if ($products->isEmpty())
            <div class="mt-10 rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center">
                <span class="text-4xl" aria-hidden="true">🔎</span>
                @if ($hasFilters)
                    <h2 class="mt-4 text-lg font-semibold text-slate-900">Ничего не найдено</h2>
                    <p class="mt-2 text-sm text-slate-500">Попробуйте изменить запрос или выбрать другую категорию.</p>
                    <a href="{{ route('catalog') }}" class="btn-secondary mt-6">Сбросить фильтры</a>
                @else
                    <h2 class="mt-4 text-lg font-semibold text-slate-900">Каталог пока пуст</h2>
                    <p class="mt-2 text-sm text-slate-500">Товары появятся здесь, как только магазин добавит их через панель управления.</p>
                    <a href="{{ route('contacts') }}" class="btn-secondary mt-6">Связаться с нами</a>
                @endif
            </div>
        @else
            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <div class="mt-10">
                {{ $products->links() }}
            </div>
        @endif

        <div class="mt-14 grid gap-4 rounded-3xl border border-slate-200 bg-white p-6 sm:grid-cols-3 sm:p-8">
            <div class="flex items-start gap-3">
                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-indigo-100 text-indigo-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h11v10H3zM14 10h4l3 3v4h-7zM7 21a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm10 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                    </svg>
                </span>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Доставка по России</h2>
                    <p class="mt-1 text-xs leading-5 text-slate-500">Курьером или самовывозом</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-emerald-100 text-emerald-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3 4 6v6c0 5 3.4 8.3 8 9 4.6-.7 8-4 8-9V6l-8-3Zm0 5v5m0 3h.01" />
                    </svg>
                </span>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Гарантия производителя</h2>
                    <p class="mt-1 text-xs leading-5 text-slate-500">Официальные устройства</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-violet-100 text-violet-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 13a8 8 0 0 1 16 0M4 13v4a2 2 0 0 0 2 2h1v-6H6a2 2 0 0 0-2 2Zm16 0v4a2 2 0 0 1-2 2h-1v-6h1a2 2 0 0 1 2 2Z" />
                    </svg>
                </span>
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Поможем с выбором</h2>
                    <p class="mt-1 text-xs leading-5 text-slate-500">Ответим на вопросы</p>
                </div>
            </div>
        </div>
    </section>
@endsection
