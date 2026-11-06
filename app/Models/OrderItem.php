<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['order_id', 'product_id', 'product_name', 'price', 'quantity'])]
class OrderItem extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'quantity' => 'integer',
        ];
    }

    /**
     * Order the line belongs to.
     *
     * @return BelongsTo<Order, $this>
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Product referenced by the line.
     *
     * @return BelongsTo<Product, $this>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Line total in kopecks.
     */
    public function lineTotal(): int
    {
        return $this->price * $this->quantity;
    }

    /**
     * Line total formatted in rubles.
     */
    protected function formattedLineTotal(): Attribute
    {
        return Attribute::get(fn (): string => number_format($this->lineTotal() / 100, 0, '.', ' ').' ₽');
    }
}
