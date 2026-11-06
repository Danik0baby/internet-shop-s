<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CatalogController extends Controller
{
    /**
     * Display the product catalog with filters.
     */
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'category' => ['nullable', 'string', 'max:255'],
            'q' => ['nullable', 'string', 'max:100'],
            'sort' => ['nullable', Rule::in(['newest', 'price_asc', 'price_desc', 'rating'])],
        ]);

        $query = Product::query()
            ->with('category')
            ->when(
                $filters['category'] ?? null,
                fn (Builder $query, string $slug) => $query->whereHas(
                    'category',
                    fn (Builder $query) => $query->where('slug', $slug)
                )
            )
            ->when(
                $filters['q'] ?? null,
                fn (Builder $query, string $search) => $query->where(function (Builder $query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('brand', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                })
            );

        match ($filters['sort'] ?? 'newest') {
            'price_asc' => $query->orderBy('price'),
            'price_desc' => $query->orderByDesc('price'),
            'rating' => $query->orderByDesc('rating')->orderByDesc('reviews'),
            default => $query->latest(),
        };

        return view('catalog', [
            'products' => $query->paginate(12)->withQueryString(),
            'categories' => Category::query()
                ->withCount('products')
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),
            'filters' => $filters,
        ]);
    }

    /**
     * Display a single product.
     */
    public function show(Product $product): View
    {
        $product->load('category');

        return view('catalog.show', [
            'product' => $product,
            'isFavorite' => auth()->check()
                && auth()->user()->favorites()->whereKey($product->getKey())->exists(),
            'related' => Product::query()
                ->where('category_id', $product->category_id)
                ->whereKeyNot($product->getKey())
                ->inStock()
                ->with('category')
                ->take(4)
                ->get(),
        ]);
    }
}
