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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('guesthouse_id')->constrained()->onDelete('cascade');
            $table->integer('rating'); // To store the rating
            $table->string('title'); // To store the review title
            $table->text('content'); // To store the review content
            $table->json('images')->nullable(); // To store the image URLs as JSON
            $table->boolean('status')->default(true);
            $table->timestamps(); // To store created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
