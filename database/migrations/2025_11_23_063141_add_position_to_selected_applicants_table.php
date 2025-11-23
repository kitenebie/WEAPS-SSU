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
        Schema::table('selected_applicants', function (Blueprint $table) {
            $table->foreignId('position')->constrained('carrers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('selected_applicants', function (Blueprint $table) {
            $table->dropForeign(['position']);
            $table->dropColumn('position');
        });
    }
};
