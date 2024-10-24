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
        Schema::table('reservations', function (Blueprint $table) {
            $table->unsignedBigInteger('pickup_location_id')->nullable();
            $table->unsignedBigInteger('dropoff_location_id')->nullable();

            // Set foreign key relationships
            $table->foreign('pickup_location_id')->references('location_id')->on('locations')->onDelete('cascade');
            $table->foreign('dropoff_location_id')->references('location_id')->on('locations')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            //
        });
    }
};
