<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete();

            $table->foreignId('subcategory_id')
                ->nullable()
                ->constrained('subcategories')
                ->nullOnDelete();

            $table->string('name_en');
            $table->string('name_ar');

            $table->string('slug')->unique();

            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();

            $table->decimal('price', 10, 2);
            $table->decimal('old_price', 10, 2)->nullable();

            $table->string('badge')->nullable()->comment('e.g. New, Sale, Best Seller');

            $table->boolean('status')
                ->default(true)
                ->index()
                ->comment('1 = Active, 0 = Inactive');

            $table->softDeletes();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};