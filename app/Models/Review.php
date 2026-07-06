<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'reviewer_name',
        'rating',
        'comment',
        'seller_response',
        'responded_at',
        'is_verified',
        'reviewable_type',
        'reviewable_id'
    ];

    public function reviewable()
    {
        return $this->morphTo();
    }
}