<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->id();

            $table->string('name_en');
            $table->string('name_ar');

            $table->string('hex_code', 20)->nullable();

            $table->boolean('status')
                ->default(true)
                ->comment('1 = Active, 0 = Inactive');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('colors');
    }
};