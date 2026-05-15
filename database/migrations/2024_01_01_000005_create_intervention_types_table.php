<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('intervention_types', function (Blueprint $table) {
            $table->id();
            $table->string('no_intervention', 50)->unique();
            $table->string('description', 200);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('intervention_types');
    }
};
