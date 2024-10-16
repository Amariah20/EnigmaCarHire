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
        Schema::create('insurances', function (Blueprint $table) {
            $table->id('insurance_id');
            $table->decimal('price');
            $table->date('due_date');
            $table->date('expiration');
            $table->string('status');
         

            $table->unsignedBigInteger('vehicle_id'); 
            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurances');
    }
};
