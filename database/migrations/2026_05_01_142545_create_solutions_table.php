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
        Schema::create('solutions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categorie_solution_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('short_description')->nullable();
            $table->text('full_description')->nullable();
            $table->string('image_path')->nullable();
            $table->string('icon')->nullable();
            $table->string('color')->default('#3b82f6');
            $table->string('link')->nullable();
            $table->string('button_text')->default('Découvrir');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solutions');
    }
};
