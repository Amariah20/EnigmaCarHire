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
            Schema::table('additional_drivers', function (Blueprint $table) {
                // Rename the column
                $table->renameColumn('additional_driver', 'additional_driver_id');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('additional_drivers', function (Blueprint $table) {
            Schema::table('additional_drivers', function (Blueprint $table) {
                // Rollback the column name change
                $table->renameColumn('additional_driver_id', 'additional_driver');
            });
        });
    }
};
