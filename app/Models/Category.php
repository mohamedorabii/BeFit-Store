<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id', 'name_en', 'name_ar', 'slug',
        'image', 'status', 'sort_order',
    ];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Category $category) {
            if (! $category->image) {
                $category->image = 'categories/default.png';
            }
        });

        static::deleting(function (Category $category) {
            if (
                $category->image
                && $category->image !== 'categories/default.png'
                && Storage::disk('public')->exists($category->image)
            ) {
                Storage::disk('public')->delete($category->image);
            }
        });
    }

    public function getNameAttribute(): string
    {
        return app()->getLocale() === 'ar'
            ? ($this->name_ar ?: $this->name_en)
            : ($this->name_en ?: $this->name_ar);
    }
}