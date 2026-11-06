@props(['product'])

@php
    $imageUrl = $product->image
        ? (\Illuminate\Support\Str::startsWith($product->image, ['http://', 'https://'])
            ? $product->image
            : \Illuminate\Support\Facades\Storage::url($product->image))
        : null;
@endphp

<article
    data-product-category="{{ $product->category->slug }}"
    class="group flex h-full flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white transition duration-300 hover:-translate-y-1 hover:border-indigo-200 hover:shadow-xl hover:shadow-slate-900/5"
>
    <a href="{{ route('catalog.show', $product) }}" class="relative flex aspect-[4/3] items-center justify-center overflow-hidden bg-slate-100">
        @if ($imageUrl)
            <img
                src="{{ $imageUrl }}"
                alt="{{ $product->name }}"
                class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                loading="lazy"
            >
        @else
            <span class="grid h-16 w-16 place-items-center rounded-2xl bg-white text-slate-300 shadow-sm">
                <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m3 16 5-5 4 4 3-3 6 6M4 4h16a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1Zm4 4h.01" />
                </svg>
            </span>
        @endif

        @if ($product->hasDiscount())
            <span class="absolute left-4 top-4 rounded-full bg-rose-600 px-3 py-1 text-xs font-semibold text-white shadow-sm">
                −{{ $product->discountPercent() }}%
            </span>
        @endif

        @unless ($product->isInStock())
            <span class="absolute inset-x-0 bottom-0 bg-slate-900/80 py-2 text-center text-xs font-semibold text-white backdrop-blur">
                Нет в наличии
            </span>
        @endunless
    </a>

    <div class="flex flex-1 flex-col gap-3 p-5">
        <div class="flex items-center justify-between gap-2 text-xs">
            <a href="{{ route('catalog', ['category' => $product->category->slug]) }}" class="rounded-full bg-slate-100 px-2.5 py-1 font-medium text-slate-600 transition hover:bg-slate-200">
                {{ $product->category->name }}
            </a>

            @if ($product->reviews > 0)
                <span class="flex items-center gap-1 font-medium text-slate-700">
                    <svg class="h-3.5 w-3.5 text-amber-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M10 15.3 4.1 18.4l1.1-6.6L.5 7.1l6.7-1L10 0l2.8 6.1 6.7 1-4.7 4.7 1.1 6.6z" />
                    </svg>
                    {{ $product->rating }}
                    <span class="font-normal text-slate-400">({{ $product->reviews }})</span>
                </span>
            @else
                <span class="text-slate-400">Нет отзывов</span>
            @endif
        </div>

        <h3 class="text-base font-semibold leading-snug text-slate-900">
            <a href="{{ route('catalog.show', $product) }}" class="transition hover:text-indigo-600">{{ $product->name }}</a>
        </h3>

        <p class="text-sm leading-6 text-slate-500">{{ \Illuminate\Support\Str::limit($product->description, 90) }}</p>

        <div class="mt-auto flex items-end justify-between gap-3 pt-2">
            <div>
                <p class="text-lg font-bold tracking-tight text-slate-900">{{ $product->formatted_price }}</p>
                @if ($product->hasDiscount())
                    <p class="text-xs font-medium text-slate-400 line-through">{{ $product->formatted_old_price }}</p>
                @endif
            </div>

            @if ($product->isInStock())
                <form method="POST" action="{{ route('cart.store', $product) }}">
                    @csrf
                    <button
                        type="submit"
                        class="rounded-full bg-slate-900 px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    >
                        В корзину
                    </button>
                </form>
            @else
                <span class="rounded-full bg-slate-100 px-4 py-2.5 text-xs font-semibold text-slate-400">
                    Нет в наличии
                </span>
            @endif
        </div>
    </div>
</article>
