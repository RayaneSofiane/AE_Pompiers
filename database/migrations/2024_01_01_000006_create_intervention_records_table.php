<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('intervention_records', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time_start');
            $table->string('address', 255);
            $table->text('summary');
            $table->unsignedBigInteger('id_type_intervention');
            $table->unsignedBigInteger('id_fire_station');
            $table->foreign('id_type_intervention')->references('id')->on('intervention_types');
            $table->foreign('id_fire_station')->references('id')->on('fire_stations');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('intervention_records');
    }
};
