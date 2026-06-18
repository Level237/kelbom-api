<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Review;
use App\Models\Stand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'stand_id',
        'category_id',
        'slug',
        'name',
        'description',
        'price',
        'compare_at_price',
        'min_order_quantity',
        'unit',
        'specifications',
        'main_image_url',
        'status',
        'views_count',
        'inquiries_count',
    ];

    protected $casts = [
        'price' => 'integer',
        'compare_at_price' => 'integer',
        'min_order_quantity' => 'integer',
        'specifications' => 'array',
        'status' => 'string',
        'views_count' => 'integer',
        'inquiries_count' => 'integer',
    ];

    protected $hidden = ['deleted_at'];

    public function stand(): BelongsTo
    {
        return $this->belongsTo(Stand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeBySeller($query, int $sellerId)
    {
        return $query->where('stand_id', $sellerId);
    }

    public function scopeByCategory($query, int $categoryId)
    {
        return $query->where('category_id', $categoryId);

    }

    public function scopeSearch($query, string $term)
    {
        // Utilise l'index FULLTEXT
        return $query->whereRaw('MATCH(name, description) AGAINST(? IN BOOLEAN MODE)', [$term . '*']);
    }

    public function scopeOrderByPopular($query)
    {
        return $query->orderByDesc('views_count')->orderByDesc('inquiries_count');
    }

    public function scopeOrderByNewest($query)
    {
        return $query->orderByDesc('created_at');
    }

    public function scopePriceRange($query, ?int $min, ?int $max)
    {
        if ($min !== null) {
            $query->where('price', '>=', $min);
        }
        if ($max !== null) {
            $query->where('price', '<=', $max);
        }
        return $query;
    }

    public function generateSlug(string $name, int $sellerId): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $count = 0;

        while (
            self::where('slug', $slug)
                ->where('stand_id', $sellerId)
                ->where('id', '!=', $this->id)
                ->exists()
        ) {
            $count++;
            $slug = $original . '-' . $count;
        }

        return $slug;
    }

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    public function incrementInquiries(): void
    {
        $this->increment('inquiries_count');
    }

    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 0, ',', ' ') . ' F';
    }

    public function getFormattedCompareAtPriceAttribute(): ?string
    {
        if (!$this->compare_at_price)
            return null;
        return number_format($this->compare_at_price, 0, ',', ' ') . ' F';
    }

    public function getDiscountPercentageAttribute(): ?int
    {
        if (!$this->compare_at_price || $this->compare_at_price <= $this->price)
            return null;
        return (int) round((($this->compare_at_price - $this->price) / $this->compare_at_price) * 100);
    }


}
