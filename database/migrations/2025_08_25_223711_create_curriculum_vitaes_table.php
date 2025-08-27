<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('curriculum_vitaes', function (Blueprint $table) {
            $table->id();
            
            // Basic Info
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            
            // Professional Info
            $table->string('job_title')->nullable();
            $table->text('summary')->nullable(); // short description
            
            // Education
            $table->string('highest_degree')->nullable();
            $table->string('university')->nullable();
            $table->year('graduation_year')->nullable();
            
            // Experience
            $table->integer('years_of_experience')->default(0);
            $table->json('skills')->nullable(); // store as array/json
            $table->json('work_experience')->nullable(); // previous jobs
            
            // Extras
            $table->string('linkedin_url')->nullable();
            $table->string('github_url')->nullable();
            $table->string('portfolio_url')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('curriculum_vitaes');
    }
};
