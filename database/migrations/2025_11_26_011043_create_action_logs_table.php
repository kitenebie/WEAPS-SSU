<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('system_logs', function (Blueprint $table) {
            // 1. Drop old columns if they exist
            if (Schema::hasColumn('system_logs', 'model_type')) {
                $table->dropColumn('model_type');
            }

            if (Schema::hasColumn('system_logs', 'user_agent')) {
                $table->dropColumn('user_agent');
            }

            if (Schema::hasColumn('system_logs', 'ip_address')) {
                $table->dropColumn('ip_address');
            }

            // 2. Rename "changes" → "modified"
            if (Schema::hasColumn('system_logs', 'changes')) {
                $table->renameColumn('changes', 'modified');
            }
        });

        Schema::table('system_logs', function (Blueprint $table) {
            // 3. Add new columns

            if (!Schema::hasColumn('system_logs', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            }

            if (!Schema::hasColumn('system_logs', 'model')) {
                $table->string('model')->nullable();
            }

            if (!Schema::hasColumn('system_logs', 'model_id')) {
                $table->unsignedBigInteger('model_id')->nullable();
            }

            if (!Schema::hasColumn('system_logs', 'modified_columns')) {
                $table->json('modified_columns')->nullable();
            }

            if (!Schema::hasColumn('system_logs', 'ip_address')) {
                $table->ipAddress('ip_address')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('system_logs', function (Blueprint $table) {
            // rollback changes here if needed
            if (Schema::hasColumn('system_logs', 'modified')) {
                $table->renameColumn('modified', 'changes');
            }

            if (Schema::hasColumn('system_logs', 'modified_columns')) {
                $table->dropColumn('modified_columns');
            }
        });
    }
};
