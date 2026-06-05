<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Review;
use App\Models\Service;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Stand extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'stand_name',
        'slug',
        'description',
        'logo_url',
        'cover_url',
        'website_url',
        'whatsapp_number',
        'is_verified',
        'rating_avg',
        'total_reviews',
        'contact_email',
        'contact_phone',
        'address',
        'city',
        'country',
        'latitude',
        'longitude',
        'total_leads_viewed',
        'total_leads_won',
    ];

    protected $casts = [
        'is_verified'       => 'boolean',
        'rating_avg'        => 'decimal:1',
        'total_reviews'     => 'integer',
        'total_leads_viewed' => 'integer',
        'total_leads_won'   => 'integer',
        'latitude'          => 'decimal:8',
        'longitude'         => 'decimal:8',
    ];

     protected $hidden = ['deleted_at'];

     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

     public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function activeProducts(): HasMany
    {
        return $this->hasMany(Product::class)->where('status', 'active');
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class)
            ->where('status', 'active')
            ->where('end_date', '>', now())
            ->latestOfMany();
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function generateSlug(string $name): string
    {
        $slug = Str::slug($name);
        $original = $slug;

        $count = 0;
        while (self::where('slug', $slug)->where('id', '!=', $this->id)->exists()) {
            $count++;
            $slug = $original . '-' . $count;
        }

        return $slug;
    }

    public function incrementViews(): void
    {
        // Pas de views_count sur seller, mais sur products
    }

    public function getFullAddressAttribute(): string
    {
        $parts = array_filter([$this->address, $this->city, $this->country]);
        return implode(', ', $parts);
    }

    public function hasEnoughCredits(int $needed = 1): bool
    {
        $credits = $this->buyleadCredits;
        return $credits && $credits->available_credits >= $needed;
    }

        public function consumeCredits(int $amount = 1): bool
    {
        $credits = $this->buyleadCredits;
        if (! $credits || $credits->available_credits < $amount) {
            return false;
        }

        $credits->decrement('available_credits', $amount);
        $credits->increment('total_consumed', $amount);

        return true;
    }

    public function recalculateRating(): void
    {
        $stats = $this->reviews()
            ->where('reviewable_type', self::class)
            ->whereNull('deleted_at')
            ->selectRaw('COUNT(*) as total, AVG(rating) as avg_rating')
            ->first();

        $this->update([
            'total_reviews' => $stats->total ?? 0,
            'rating_avg'    => round($stats->avg_rating ?? 0, 1),
        ]);
    }

}
