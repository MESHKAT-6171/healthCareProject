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
        Schema::table('health_logs', function (Blueprint $table) {
            // Adding new columns. 'nullable()' means old logs won't crash because they are missing this data.
            $table->integer('sunlight_hours')->nullable();
            $table->decimal('water_liters', 3, 1)->nullable(); // Allows decimals like 2.5
            $table->integer('stress_level')->nullable(); // 1 to 10 scale
        });
    }

    public function down(): void
    {
        Schema::table('health_logs', function (Blueprint $table) {
            $table->dropColumn(['sunlight_hours', 'water_liters', 'stress_level']);
        });
    }
};
