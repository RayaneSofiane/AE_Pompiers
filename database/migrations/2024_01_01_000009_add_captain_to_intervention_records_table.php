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
        Schema::table('intervention_records', function (Blueprint $table) {
            $table->foreignId('id_captain')->nullable()->constrained('firefighters')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('intervention_records', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_captain');
        });
    }
};
