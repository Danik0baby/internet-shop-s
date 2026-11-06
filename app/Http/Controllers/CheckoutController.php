<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Enums\OrderStatus;
use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Display the checkout form.
     */
    public function create(Cart $cart): View|RedirectResponse
    {
        if ($cart->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста.');
        }

        return view('checkout.create', [
            'items' => $cart->items(),
            'subtotal' => $cart->subtotal(),
        ]);
    }

    /**
     * Place an order from the current cart.
     */
    public function store(CheckoutRequest $request, Cart $cart): RedirectResponse
    {
        $items = $cart->items();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста.');
        }

        foreach ($items as $item) {
            if ($item['quantity'] > $item['product']->stock) {
                return redirect()
                    ->route('cart.index')
                    ->with('error', 'Недостаточно товара «'.$item['product']->name.'» на складе.');
            }
        }

        $order = DB::transaction(function () use ($items, $request): Order {
            $order = Order::create([
                'user_id' => $request->user()->getKey(),
                'number' => 'NV-TMP-'.Str::uuid(),
                'status' => OrderStatus::New,
                'total' => (int) $items->sum('total'),
                ...$request->safe()->only([
                    'customer_name',
                    'email',
                    'phone',
                    'city',
                    'address',
                    'comment',
                    'delivery_method',
                    'payment_method',
                ]),
            ]);

            $order->update([
                'number' => 'NV-'.str_pad((string) $order->getKey(), 6, '0', STR_PAD_LEFT),
            ]);

            foreach ($items as $item) {
                $order->items()->create([
                    'product_id' => $item['product']->getKey(),
                    'product_name' => $item['product']->name,
                    'price' => $item['product']->price,
                    'quantity' => $item['quantity'],
                ]);

                $item['product']->decrement('stock', $item['quantity']);
            }

            return $order;
        });

        $cart->clear();

        return redirect()
            ->route('checkout.success', $order)
            ->with('status', 'Заказ оформлен. Номер: '.$order->number);
    }

    /**
     * Display the order confirmation.
     */
    public function success(Request $request, Order $order): View
    {
        Gate::authorize('view', $order);

        $order->load('items');

        return view('checkout.success', [
            'order' => $order,
        ]);
    }
}
