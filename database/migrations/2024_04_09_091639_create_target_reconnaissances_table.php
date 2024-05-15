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
        Schema::create('target_reconnaissances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('position_id')->constrained('position')->cascadeOnDelete();
            $table->foreignId('task_id')->constrained('task')->cascadeOnDelete();
            $table->foreignId('position_type_id')->constrained('position_type')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('status');
            $table->longText('description')->nullable();
            $table->string('documents')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('target_reconnaissances');
    }
};
