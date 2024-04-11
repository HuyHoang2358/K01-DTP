<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('city_model', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model_code');
            $table->string('texture_model_url')->nullable();
            $table->string('no_texture_model_url')->nullable();
            $table->double('scale')->default(1);
            $table->double('heading')->default(0);
            $table->double('pitch')->default(0);
            $table->double('roll')->default(0);
            $table->foreignId('object_category_id')->constrained('object_category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('city_model');
    }
};
