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
        Schema::create('route_position', function (Blueprint $table) {
            $table->id();
            $table->foreignId('route_id')->constrained('route')->cascadeOnDelete();
            $table->foreignId('position_id')->constrained('position')->cascadeOnDelete();
            $table->bigInteger('index');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('route_position');
    }
};
