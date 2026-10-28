<?php

namespace App\Models;

use App\Support\Localize;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'kind',
        'description',
        'icon',
        'image_url',
        'sort_order',
        'is_active',
    ];
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

    public function resolvedKind(): ?string
    {
        return $this->kind ?: $this->parent?->kind;
    }

    public function translatedName(): string
    {
        return Localize::line('categories.'.$this->slug, $this->name);
    }
}
