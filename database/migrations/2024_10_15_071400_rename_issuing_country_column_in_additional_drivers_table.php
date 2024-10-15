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
        Schema::table('additional_drivers', function (Blueprint $table) {
            $table->renameColumn('issuing country', 'issuing_country');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('additional_drivers', function (Blueprint $table) {
            $table->renameColumn('issuing_country', 'issuing country');
        });
    }
};
