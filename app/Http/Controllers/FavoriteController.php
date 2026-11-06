<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display products favorited by the current user.
     */
    public function index(Request $request): View
    {
        return view('favorites.index', [
            'products' => $request->user()
                ->favorites()
                ->with('category')
                ->orderByPivot('created_at', 'desc')
                ->paginate(12),
        ]);
    }

    /**
     * Add or remove a product from favorites.
     */
    public function toggle(Request $request, Product $product): RedirectResponse
    {
        $result = $request->user()->favorites()->toggle($product->getKey());

        $added = count($result['attached']) > 0;

        return back()->with(
            'status',
            $added ? 'Товар добавлен в избранное.' : 'Товар удалён из избранного.'
        );
    }
}
