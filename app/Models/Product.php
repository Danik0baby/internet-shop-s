<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'category_id',
    'slug',
    'name',
    'brand',
    'description',
    'specs',
    'image',
    'price',
    'old_price',
    'stock',
    'rating',
    'reviews',
    'is_featured',
])]
class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'specs' => 'array',
            'price' => 'integer',
            'old_price' => 'integer',
            'stock' => 'integer',
            'rating' => 'float',
            'reviews' => 'integer',
            'is_featured' => 'boolean',
        ];
    }

    /**
     * Category the product belongs to.
     *
     * @return BelongsTo<Category, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Order lines that reference the product.
     *
     * @return HasMany<OrderItem, $this>
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Users who added the product to favorites.
     *
     * @return BelongsToMany<User, $this>
     */
    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    /**
     * Use the slug as the route key.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Whether the product has a discount.
     */
    public function hasDiscount(): bool
    {
        return $this->old_price !== null && $this->old_price > $this->price;
    }

    /**
     * Discount percentage, if any.
     */
    public function discountPercent(): ?int
    {
        if (! $this->hasDiscount()) {
            return null;
        }

        return (int) round((1 - $this->price / $this->old_price) * 100);
    }

    /**
     * Whether the product can be purchased right now.
     */
    public function isInStock(): bool
    {
        return $this->stock > 0;
    }

    /**
     * Price formatted in rubles.
     */
    protected function formattedPrice(): Attribute
    {
        return Attribute::get(fn (): string => number_format($this->price / 100, 0, '.', ' ').' ₽');
    }

    /**
     * Old price formatted in rubles.
     */
    protected function formattedOldPrice(): Attribute
    {
        return Attribute::get(
            fn (): ?string => $this->old_price === null
                ? null
                : number_format($this->old_price / 100, 0, '.', ' ').' ₽'
        );
    }

    /**
     * Scope a query to products that are available for purchase.
     *
     * @param  Builder<Product>  $query
     */
    public function scopeInStock(Builder $query): void
    {
        $query->where('stock', '>', 0);
    }

    /**
     * Scope a query to featured products.
     *
     * @param  Builder<Product>  $query
     */
    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }
}
