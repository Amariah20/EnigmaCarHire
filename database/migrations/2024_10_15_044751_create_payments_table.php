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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->decimal('total_price');
            $table->decimal('total_paid');
            $table->date('payment_date');
            $table->string('status');
            
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
        Schema::dropIfExists('payments');
    }
};
