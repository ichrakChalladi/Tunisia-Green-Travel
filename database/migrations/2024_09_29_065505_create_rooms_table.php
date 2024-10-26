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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guesthouse_id')->constrained()->onDelete('cascade'); // Foreign key to guesthouses table
            $table->string('name');
            $table->enum('room_type', ['single', 'double', 'suite'])->default('single');
            $table->decimal('price', 8, 2);
            $table->text('description');
            $table->enum('status', ['available', 'out_of_stock', 'discontinued'])->default('available');
            $table->integer('floor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
