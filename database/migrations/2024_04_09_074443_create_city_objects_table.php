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
        Schema::create('city_object', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('city_id')->nullable();
            $table->foreignId('city_model_id')->constrained('city_model')->cascadeOnDelete();
            $table->foreignId('address_id')->constrained('address')->cascadeOnDelete();
            $table->foreignId('position_id')->constrained('position')->cascadeOnDelete();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->boolean('is_show_name')->default(true);
            $table->double('name_height')->default(20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('city_object');
    }
};
