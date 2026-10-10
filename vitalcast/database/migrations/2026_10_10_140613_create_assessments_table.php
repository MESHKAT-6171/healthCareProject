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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('age');
            $table->decimal('bmi', 4, 1);
            $table->string('diet_type');
            $table->string('sun_exposure');
            $table->string('latitude_region');
            $table->boolean('has_bone_pain')->default(false);
            $table->boolean('has_fatigue')->default(false);
            $table->boolean('has_muscle_weakness')->default(false);
            $table->string('risk_level');
            $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
