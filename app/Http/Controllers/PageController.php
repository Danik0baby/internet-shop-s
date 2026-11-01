<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    /**
     * Display the shop landing page.
     */
    public function home(): View
    {
        return view('home', [
            'categories' => config('catalog.categories'),
            'featuredProducts' => array_slice(config('catalog.products'), 0, 4),
        ]);
    }

    /**
     * Display the about page.
     */
    public function about(): View
    {
        return view('about');
    }
}
