<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'stock',
        'sku',
    ];

    protected $casts = [
        'stock' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (ProductVariant $variant) {
            if (! empty($variant->sku)) {
                return;
            }

            $product = $variant->product ?? Product::find($variant->product_id);
            $color = $variant->color ?? Color::find($variant->color_id);
            $size = $variant->size ?? Size::find($variant->size_id);

            $base = strtoupper(Str::slug($product?->name_en ?? 'PRD', '-'))
                . '-' . strtoupper($color?->name_en ?? 'COL')
                . '-' . strtoupper($size?->name_en ?? 'SZ');

            $sku = $base;
            $counter = 1;

            while (static::where('sku', $sku)->exists()) {
                $sku = $base . '-' . $counter;
                $counter++;
            }

            $variant->sku = $sku;
        });
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }
}