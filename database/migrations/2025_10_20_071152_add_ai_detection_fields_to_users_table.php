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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('face_detection')->nullable();
            $table->text('detection_reason')->nullable();
            $table->boolean('AI_result')->nullable();
            $table->text('AI_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['face_detection', 'detection_reason', 'AI_result', 'AI_reason']);
        });
    }
};
