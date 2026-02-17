<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('career_jobs', function (Blueprint $table) {
            if (!Schema::hasColumn('career_jobs', 'work_mode')) {
                $table->string('work_mode', 20)->default('hybrid')->after('type');
            }

            if (!Schema::hasColumn('career_jobs', 'hide_salary_range')) {
                $table->boolean('hide_salary_range')->default(false)->after('salary_range');
            }

            if (!Schema::hasColumn('career_jobs', 'custom_questions')) {
                $table->json('custom_questions')->nullable()->after('hide_salary_range');
            }

            if (!Schema::hasColumn('career_jobs', 'whatsapp_inquiry_template')) {
                $table->text('whatsapp_inquiry_template')->nullable()->after('custom_questions');
            }
        });

        Schema::table('job_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('job_applications', 'cover_letter')) {
                $table->text('cover_letter')->nullable()->after('position_title');
            }

            if (!Schema::hasColumn('job_applications', 'portfolio_url')) {
                $table->string('portfolio_url')->nullable()->after('cover_letter');
            }

            if (!Schema::hasColumn('job_applications', 'custom_answers')) {
                $table->json('custom_answers')->nullable()->after('portfolio_url');
            }
        });
    }

    public function down(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            if (Schema::hasColumn('job_applications', 'custom_answers')) {
                $table->dropColumn('custom_answers');
            }

            if (Schema::hasColumn('job_applications', 'portfolio_url')) {
                $table->dropColumn('portfolio_url');
            }

            if (Schema::hasColumn('job_applications', 'cover_letter')) {
                $table->dropColumn('cover_letter');
            }
        });

        Schema::table('career_jobs', function (Blueprint $table) {
            if (Schema::hasColumn('career_jobs', 'whatsapp_inquiry_template')) {
                $table->dropColumn('whatsapp_inquiry_template');
            }

            if (Schema::hasColumn('career_jobs', 'custom_questions')) {
                $table->dropColumn('custom_questions');
            }

            if (Schema::hasColumn('career_jobs', 'hide_salary_range')) {
                $table->dropColumn('hide_salary_range');
            }

            if (Schema::hasColumn('career_jobs', 'work_mode')) {
                $table->dropColumn('work_mode');
            }
        });
    }
};
