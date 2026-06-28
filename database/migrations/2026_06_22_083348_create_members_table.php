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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('people_id')->constrained('people')->cascadeOnDelete();
            $table->foreignId('house_id')->constrained('houses')->restrictOnDelete();
            $table->foreignId('academic_year_id')->constrained('academic_years')->restrictOnDelete();
            $table->enum('role', ['captain','vice_captain','advisor','member'])->default('member');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['people_id','academic_year_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
