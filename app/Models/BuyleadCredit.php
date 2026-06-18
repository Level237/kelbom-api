<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class BuyleadCredit extends Model
{
    protected $fillable = [
        'available_credits',
    ];

    public function stand()
    {
        return $this->belongsTo(User::class);
    }
}
