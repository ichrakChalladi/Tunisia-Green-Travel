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
        Schema::create('transport_options', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the transport option
            $table->enum('disponibilité', ['disponible', 'non-disponible']); // Availability status
            $table->float('carbon_empreinte'); // Carbon footprint value
            $table->enum('type', ['bus', 'train', 'car', 'bicycle', 'airplane'])->default('car'); // Type of transport
            $table->text('description')->nullable(); // Optional description
            $table->integer('capacity')->nullable(); // Optional capacity
            $table->float('price_per_km')->nullable(); // Optional price per kilometer
            $table->string('contact_info')->nullable(); // Optional contact information
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transport_options');
    }
};
