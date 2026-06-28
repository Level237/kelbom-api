<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{



    public function stands()
    {
        return $this->belongsToMany(Stand::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
