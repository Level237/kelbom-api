<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'description',
        'quantity',
        'budget',
        'reference_image',
        'urgency',
        'name',
        'country',
        'city',
        'contact',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
