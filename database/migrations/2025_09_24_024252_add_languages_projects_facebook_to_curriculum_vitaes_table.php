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
            $table->json('languages')->nullable();
            $table->json('projects')->nullable();
            $table->string('facebook_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('curriculum_vitaes', function (Blueprint $table) {
            $table->dropColumn(['languages', 'projects', 'facebook_url']);
        });
    }
};
