<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class CatalogController extends Controller
{
    /**
     * Display the product catalog.
     */
    public function index(): View
    {
        return view('catalog', [
            'categories' => config('catalog.categories'),
            'products' => config('catalog.products'),
        ]);
    }
}
