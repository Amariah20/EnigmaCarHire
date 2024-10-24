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
        Schema::create('extra_reservation', function (Blueprint $table) {
            $table->unsignedBigInteger('extra_id')->nullable(); 
            $table->foreign('extra_id')->references('extra_id')->on('extras')->onDelete('cascade'); // Add the foreign key constraint


            $table->unsignedBigInteger('reservation_id'); 
            $table->foreign('reservation_id')->references('reservation_id')->on('reservations')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extra_reservation');
    }
};
