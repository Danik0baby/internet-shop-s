<?php

namespace App;

use App\Models\Product;
use Illuminate\Support\Collection;

class Cart
{
    private const SESSION_KEY = 'cart';

    /**
     * Cart lines with products, quantities and line totals.
     *
     * @return Collection<int, array{product: Product, quantity: int, total: int}>
     */
    public function items(): Collection
    {
        $quantities = $this->quantities();

        if ($quantities === []) {
            return collect();
        }

        $products = Product::query()
            ->with('category')
            ->whereIn('id', array_keys($quantities))
            ->get()
            ->keyBy('id');

        return collect($quantities)
            ->filter(fn (int $quantity, int $productId): bool => $products->has($productId))
            ->map(fn (int $quantity, int $productId): array => [
                'product' => $products->get($productId),
                'quantity' => $quantity,
                'total' => $products->get($productId)->price * $quantity,
            ])
            ->values();
    }

    /**
     * Add a product to the cart without exceeding the available stock.
     */
    public function add(Product $product, int $quantity = 1): void
    {
        if (! $product->isInStock()) {
            return;
        }

        $quantities = $this->quantities();
        $current = $quantities[$product->id] ?? 0;

        $quantities[$product->id] = min($current + max(1, $quantity), $product->stock);

        $this->store($quantities);
    }

    /**
     * Update the quantity of a product in the cart.
     */
    public function update(Product $product, int $quantity): void
    {
        $quantities = $this->quantities();

        if ($quantity <= 0 || ! $product->isInStock()) {
            unset($quantities[$product->id]);
        } else {
            $quantities[$product->id] = min($quantity, $product->stock);
        }

        $this->store($quantities);
    }

    /**
     * Remove a product from the cart.
     */
    public function remove(Product $product): void
    {
        $quantities = $this->quantities();

        unset($quantities[$product->id]);

        $this->store($quantities);
    }

    /**
     * Remove every product from the cart.
     */
    public function clear(): void
    {
        session()->forget(self::SESSION_KEY);
    }

    /**
     * Total number of items in the cart.
     */
    public function count(): int
    {
        return array_sum($this->quantities());
    }

    /**
     * Cart subtotal in kopecks.
     */
    public function subtotal(): int
    {
        return (int) $this->items()->sum('total');
    }

    /**
     * Whether the cart is empty.
     */
    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    /**
     * Stored product quantities keyed by product id.
     *
     * @return array<int, int>
     */
    private function quantities(): array
    {
        $cart = session()->get(self::SESSION_KEY, []);

        return is_array($cart) ? array_map('intval', $cart) : [];
    }

    /**
     * Persist product quantities to the session.
     *
     * @param  array<int, int>  $quantities
     */
    private function store(array $quantities): void
    {
        session()->put(self::SESSION_KEY, $quantities);
    }
}
