<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    /**
     * Display the shop landing page.
     */
    public function home(): View
    {
        return view('home', [
            'categories' => Category::query()
                ->withCount('products')
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),
            'featuredProducts' => Product::query()
                ->featured()
                ->inStock()
                ->with('category')
                ->latest()
                ->take(4)
                ->get(),
            'productCount' => Product::query()->count(),
            'categoryCount' => Category::query()->count(),
        ]);
    }

    /**
     * Display the storefront menu with every category.
     */
    public function menu(): View
    {
        return view('menu', [
            'categories' => Category::query()
                ->withCount('products')
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),
        ]);
    }

    /**
     * Display the about page.
     */
    public function about(): View
    {
        return view('about');
    }

    /**
     * Display delivery and payment information.
     */
    public function delivery(): View
    {
        return view('delivery');
    }
}
