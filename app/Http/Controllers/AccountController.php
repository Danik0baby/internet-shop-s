<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AccountController extends Controller
{
    /**
     * Display the customer account with recent orders.
     */
    public function index(Request $request): View
    {
        return view('account.index', [
            'user' => $request->user(),
            'orders' => $request->user()
                ->orders()
                ->withCount('items')
                ->latest()
                ->paginate(10),
        ]);
    }

    /**
     * Display a single order of the current customer.
     */
    public function order(Order $order): View
    {
        Gate::authorize('view', $order);

        $order->load(['items.product.category']);

        return view('account.order', [
            'order' => $order,
        ]);
    }

    /**
     * Update the customer profile.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->update($request->validated());

        return back()->with('status', 'Профиль обновлён.');
    }
}
