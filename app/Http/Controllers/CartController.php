<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the cart.
     */
    public function index(Cart $cart): View
    {
        return view('cart.index', [
            'items' => $cart->items(),
            'subtotal' => $cart->subtotal(),
        ]);
    }

    /**
     * Add a product to the cart.
     */
    public function store(Request $request, Product $product, Cart $cart): RedirectResponse
    {
        if (! $product->isInStock()) {
            return back()->with('error', 'Товара нет в наличии.');
        }

        $cart->add($product, max(1, $request->integer('quantity', 1)));

        return back()->with('status', 'Товар добавлен в корзину.');
    }

    /**
     * Update the quantity of a product in the cart.
     */
    public function update(Request $request, Product $product, Cart $cart): RedirectResponse
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:0'],
        ]);

        $cart->update($product, $data['quantity']);

        return back()->with('status', 'Корзина обновлена.');
    }

    /**
     * Remove a product from the cart.
     */
    public function destroy(Product $product, Cart $cart): RedirectResponse
    {
        $cart->remove($product);

        return back()->with('status', 'Товар удалён из корзины.');
    }
}
