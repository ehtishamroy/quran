<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->json('features')->nullable(); // List of bullet points
            $table->decimal('price', 8, 2);
            $table->string('currency')->default('GBP');
            $table->integer('duration_minutes')->nullable();
            $table->integer('days_per_week')->nullable();
            $table->boolean('is_popular')->default(false);
            $table->string('color_theme')->default('green'); // green, orange, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
