<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            $table->foreignId('color_id')
                ->constrained('colors');

            $table->foreignId('size_id')
                ->constrained('sizes');

            $table->unsignedInteger('stock')->default(0);

            $table->string('sku')->nullable()->unique();

            $table->timestamps();

            $table->unique(['product_id', 'color_id', 'size_id'], 'product_variant_unique_combo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};