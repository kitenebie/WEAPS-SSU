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
        Schema::table('curriculum_vitaes', function (Blueprint $table) {
            $table->string('highest_degree')->nullable();
            $table->string('university')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('curriculum_vitaes', function (Blueprint $table) {
            $table->dropColumn(['highest_degree', 'university']);
        });
    }
};
