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
        Schema::create('carbon_footprint_by_trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transport_option_id')->constrained()->onDelete('cascade');
            $table->string('starting_point');
            $table->string('destination');
            $table->float('distance');
            $table->integer('passengers');
            $table->date('start_date');
            $table->date('end_date');
            $table->float('calculated_carbon_footprint')->nullable();
            $table->float('trip_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carbon_footprint_by_trips');
    }
};
