<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'category_id', 'brand_id', 'model',
        'cpu', 'ram', 'storage', 'gpu', 'screen', 'os',
        'weight', 'battery', 'ports', 'price', 'sale_price',
        'stock', 'warranty', 'image', 'description',
        'is_featured', 'is_new', 'views', 'status',
    ];

    protected $casts = [
        'price' => 'integer',
        'sale_price' => 'integer',
        'stock' => 'integer',
        'views' => 'integer',
        'weight' => 'float',
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
        'status' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $product) {
            if (empty($product->slug)) {
                $product->slug = static::generateUniqueSlug($product->name, $product->id);
            }
        });
    }

    // ===== Relations =====

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // ===== Scopes =====

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 1);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', 1);
    }

    public function scopeNew(Builder $query): Builder
    {
        return $query->where('is_new', 1);
    }

    public function scopeInCategory(Builder $query, int $categoryId): Builder
    {
        return $query->where('category_id', $categoryId);
    }

    // ===== Accessors =====

    public function getDisplayPriceAttribute(): int
    {
        return (int) ($this->sale_price ?: $this->price);
    }

    public function getDiscountPercentAttribute(): int
    {
        if (!$this->sale_price || $this->sale_price >= $this->price) {
            return 0;
        }
        return (int) round((($this->price - $this->sale_price) / $this->price) * 100);
    }

    public function getInStockAttribute(): bool
    {
        return $this->stock > 0;
    }

    // ===== Helpers =====

    protected static function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name) ?: 'laptop';
        $slug = $base;
        $i = 2;

        while (static::where('slug', $slug)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}
