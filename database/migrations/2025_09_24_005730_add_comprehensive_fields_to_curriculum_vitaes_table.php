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
            $table->json('certifications')->nullable();
            $table->json('awards')->nullable();
            $table->json('affiliations')->nullable();
            $table->json('publications')->nullable();
            $table->json('volunteer_work')->nullable();
            $table->json('references')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('curriculum_vitaes', function (Blueprint $table) {
            $table->dropColumn([
                'certifications',
                'awards',
                'affiliations',
                'publications',
                'volunteer_work',
                'references'
            ]);
        });
    }
};
