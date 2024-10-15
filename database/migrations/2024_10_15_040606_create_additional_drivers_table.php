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
        Schema::create('additional_drivers', function (Blueprint $table) {
            $table->id('additional_driver');
            $table->string('name');
            $table->string('license_number');
            $table->string('issuing country');

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
        Schema::dropIfExists('additional_drivers');
    }
};
