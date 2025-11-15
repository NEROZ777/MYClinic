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
        Schema::create('patient_chronic_diseases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_profile_id')->constrained()->onDelete('cascade');
            $table->foreignId('chronic_disease_id')->constrained()->onDelete('cascade');
            $table->boolean('suffer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_chronic_diseases');
    }
};
