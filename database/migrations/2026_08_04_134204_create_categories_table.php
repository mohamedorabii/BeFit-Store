<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->string('name_en');
            $table->string('name_ar');

            $table->string('slug')->unique();

            $table->string('image')->nullable();

            $table->boolean('status')
                ->default(true)
                ->index()
                ->comment('1 = Active, 0 = Inactive');

            $table->unsignedSmallInteger('sort_order')
                ->default(0)
                ->comment('Display order');

            $table->softDeletes();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};