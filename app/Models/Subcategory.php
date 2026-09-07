<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Subcategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name_en',
        'name_ar',
        'slug',
        'image',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::creating(function (Subcategory $subcategory) {
            if (! $subcategory->image) {
                $subcategory->image = 'subcategories/default.png';
            }
        });

        static::deleting(function (Subcategory $subcategory) {
            if (
                $subcategory->image
                && $subcategory->image !== 'subcategories/default.png'
                && Storage::disk('public')->exists($subcategory->image)
            ) {
                Storage::disk('public')->delete($subcategory->image);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}