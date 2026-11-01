@props(['product'])

@php
    $category = config('catalog.categories.'.$product['category']);
    $price = number_format($product['price'], 0, '.', ' ');
    $oldPrice = $product['old_price'] ? number_format($product['old_price'], 0, '.', ' ') : null;
@endphp

<article
    data-product-category="{{ $product['category'] }}"
    class="group flex h-full flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white transition duration-300 hover:-translate-y-1 hover:border-indigo-200 hover:shadow-xl hover:shadow-slate-900/5"
>
    <div class="relative flex aspect-[4/3] items-center justify-center overflow-hidden bg-gradient-to-br {{ $product['gradient'] }}">
        <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/20 blur-2xl"></div>
        <div class="absolute -bottom-12 -left-8 h-32 w-32 rounded-full bg-white/10 blur-2xl"></div>

        @if ($product['badge'])
            <span class="absolute left-4 top-4 rounded-full bg-white/95 px-3 py-1 text-xs font-semibold text-slate-900 shadow-sm">
                {{ $product['badge'] }}
            </span>
        @endif

        <span class="relative text-6xl drop-shadow-xl transition duration-300 group-hover:scale-110 sm:text-7xl" aria-hidden="true">
            {{ $product['emoji'] }}
        </span>
    </div>

    <div class="flex flex-1 flex-col gap-3 p-5">
        <div class="flex items-center justify-between gap-2 text-xs">
            <span class="rounded-full bg-slate-100 px-2.5 py-1 font-medium text-slate-600">{{ $category['label'] }}</span>
            <span class="flex items-center gap-1 font-medium text-slate-700">
                <svg class="h-3.5 w-3.5 text-amber-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path d="M10 15.3 4.1 18.4l1.1-6.6L.5 7.1l6.7-1L10 0l2.8 6.1 6.7 1-4.7 4.7 1.1 6.6z" />
                </svg>
                {{ $product['rating'] }}
                <span class="font-normal text-slate-400">({{ $product['reviews'] }})</span>
            </span>
        </div>

        <h3 class="text-base font-semibold leading-snug text-slate-900">{{ $product['name'] }}</h3>
        <p class="text-sm leading-6 text-slate-500">{{ $product['description'] }}</p>

        <div class="mt-auto flex items-end justify-between gap-3 pt-2">
            <div>
                <p class="text-lg font-bold tracking-tight text-slate-900">{{ $price }} ₽</p>
                @if ($oldPrice)
                    <p class="text-xs font-medium text-slate-400 line-through">{{ $oldPrice }} ₽</p>
                @endif
            </div>

            <button
                type="button"
                data-add-to-cart
                class="rounded-full bg-slate-900 px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:cursor-not-allowed disabled:bg-emerald-600"
                aria-label="Добавить {{ $product['name'] }} в корзину"
            >
                В корзину
            </button>
        </div>
    </div>
</article>
