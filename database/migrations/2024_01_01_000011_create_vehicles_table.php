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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('no_identification', 50)->unique();
            $table->string('immatriculation', 20)->unique();
            $table->integer('annee_mise_en_service');
            $table->string('marque', 100);
            $table->string('modele', 100);
            $table->foreignId('id_type_vehicle')->constrained('vehicle_types')->onDelete('restrict');
            $table->foreignId('id_fire_station')->constrained('fire_stations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
