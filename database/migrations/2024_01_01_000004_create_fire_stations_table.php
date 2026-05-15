<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fire_stations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('address', 200);
            $table->string('city', 100);
            $table->string('phone', 12);
            $table->unsignedBigInteger('id_state');
            $table->foreign('id_state')->references('id')->on('states');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fire_stations');
    }
};
