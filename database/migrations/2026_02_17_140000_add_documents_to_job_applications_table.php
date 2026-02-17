<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('job_applications', 'id_ktp_path')) {
                $table->string('id_ktp_path')->nullable()->after('resume_path');
            }

            if (!Schema::hasColumn('job_applications', 'skck_path')) {
                $table->string('skck_path')->nullable()->after('id_ktp_path');
            }

            if (!Schema::hasColumn('job_applications', 'cover_letter_file_path')) {
                $table->string('cover_letter_file_path')->nullable()->after('skck_path');
            }

            if (!Schema::hasColumn('job_applications', 'portfolio_file_path')) {
                $table->string('portfolio_file_path')->nullable()->after('cover_letter_file_path');
            }

            if (!Schema::hasColumn('job_applications', 'attachment_link')) {
                $table->string('attachment_link')->nullable()->after('portfolio_file_path');
            }
        });
    }

    public function down(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            if (Schema::hasColumn('job_applications', 'attachment_link')) {
                $table->dropColumn('attachment_link');
            }
            if (Schema::hasColumn('job_applications', 'portfolio_file_path')) {
                $table->dropColumn('portfolio_file_path');
            }
            if (Schema::hasColumn('job_applications', 'cover_letter_file_path')) {
                $table->dropColumn('cover_letter_file_path');
            }
            if (Schema::hasColumn('job_applications', 'skck_path')) {
                $table->dropColumn('skck_path');
            }
            if (Schema::hasColumn('job_applications', 'id_ktp_path')) {
                $table->dropColumn('id_ktp_path');
            }
        });
    }
};

