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
        Schema::create('firefighters', function (Blueprint $table) {
            $table->id();
            $table->string('matricule', 20)->unique();
            $table->foreignId('id_grade')->constrained('grades')->onDelete('restrict');
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->foreignId('id_fire_station')->constrained('fire_stations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('firefighters');
    }
};
