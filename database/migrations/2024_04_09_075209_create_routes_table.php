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
        Schema::create('route', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->foreignId('start_position_id')->constrained('position')->cascadeOnDelete();
            $table->foreignId('end_position_id')->constrained('position')->cascadeOnDelete();
            $table->string('start_address');
            $table->string('end_address');
            $table->string('status');
            $table->foreignId('task_id')->constrained('task')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('route');
    }
};
