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
        Schema::create('guesthouses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table            $table->string('name'); // Add this for guesthouse name
            $table->string('location');
            $table->integer('number_of_rooms');
            $table->text('booking_policies');
            $table->text('description'); // Removed extra space in 'description'
            $table->json('images')->nullable();
            $table->timestamps();
        });
    }
      
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guesthouses');
    }
};
