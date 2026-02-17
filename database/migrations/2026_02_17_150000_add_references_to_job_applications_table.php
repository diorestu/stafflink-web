<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('job_applications', 'reference_name')) {
                $table->string('reference_name')->nullable()->after('attachment_link');
            }

            if (!Schema::hasColumn('job_applications', 'reference_company')) {
                $table->string('reference_company')->nullable()->after('reference_name');
            }

            if (!Schema::hasColumn('job_applications', 'reference_phone')) {
                $table->string('reference_phone')->nullable()->after('reference_company');
            }

            if (!Schema::hasColumn('job_applications', 'reference_email')) {
                $table->string('reference_email')->nullable()->after('reference_phone');
            }

            if (!Schema::hasColumn('job_applications', 'reference_token')) {
                $table->uuid('reference_token')->nullable()->unique()->after('reference_email');
            }
        });
    }

    public function down(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            if (Schema::hasColumn('job_applications', 'reference_token')) {
                $table->dropUnique(['reference_token']);
                $table->dropColumn('reference_token');
            }
            if (Schema::hasColumn('job_applications', 'reference_email')) {
                $table->dropColumn('reference_email');
            }
            if (Schema::hasColumn('job_applications', 'reference_phone')) {
                $table->dropColumn('reference_phone');
            }
            if (Schema::hasColumn('job_applications', 'reference_company')) {
                $table->dropColumn('reference_company');
            }
            if (Schema::hasColumn('job_applications', 'reference_name')) {
                $table->dropColumn('reference_name');
            }
        });
    }
};

