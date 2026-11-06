@extends('layouts.app')

@section('title', 'Меню магазина — '.config('shop.name', 'NOVA'))
@section('meta_description', 'Все категории магазина: выберите раздел и переходите к товарам.')

@section('content')
    <section class="container-page pt-10 sm:pt-14">
        <nav class="flex items-center gap-2 text-xs font-medium text-slate-500" aria-label="Хлебные крошки">
            <a href="{{ route('home') }}" class="transition hover:text-slate-900">Главная</a>
            <span aria-hidden="true">/</span>
            <span class="text-slate-900">Меню</span>
        </nav>

        <div class="mt-6 max-w-2xl">
            <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">Меню магазина</h1>
            <p class="mt-4 text-base leading-7 text-slate-600">
                Все категории каталога в одном месте. Выберите раздел, чтобы посмотреть товары.
            </p>
        </div>
    </section>

    <section class="container-page pb-20 pt-10">
        @if ($categories->isEmpty())
            <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center">
                <span class="grid h-14 w-14 mx-auto place-items-center rounded-2xl bg-slate-100 text-slate-400">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h10" />
                    </svg>
                </span>
                <h2 class="mt-5 text-lg font-semibold text-slate-900">Меню пока пустое</h2>
                <p class="mt-2 text-sm text-slate-500">Категории появятся после наполнения каталога через панель управления.</p>
                <a href="{{ route('contacts') }}" class="btn-secondary mt-6">Связаться с нами</a>
            </div>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($categories as $category)
                    <a
                        href="{{ route('catalog', ['category' => $category->slug]) }}"
                        class="group flex items-start gap-5 rounded-3xl border border-slate-200 bg-white p-6 transition duration-300 hover:-translate-y-1 hover:border-indigo-200 hover:shadow-lg hover:shadow-slate-900/5"
                    >
                        <span class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl bg-slate-100 text-lg font-bold uppercase text-slate-500 transition group-hover:bg-indigo-50 group-hover:text-indigo-600">
                            {{ mb_substr($category->name, 0, 1) }}
                        </span>

                        <span class="min-w-0">
                            <span class="block text-base font-semibold text-slate-900">{{ $category->name }}</span>
                            <span class="mt-1 block text-sm leading-6 text-slate-500">
                                {{ $category->description ?: 'Товары категории в каталоге' }}
                            </span>
                            <span class="mt-3 inline-flex items-center gap-1 text-xs font-semibold text-indigo-600">
                                {{ trans_choice(':count товар|:count товара|:count товаров', $category->products_count, ['count' => $category->products_count]) }}
                                <span aria-hidden="true">→</span>
                            </span>
                        </span>
                    </a>
                @endforeach
            </div>
        @endif
    </section>
@endsection
