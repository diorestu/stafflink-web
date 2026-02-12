<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('job_applications', 'city')) {
            Schema::table('job_applications', function (Blueprint $table) {
                $table->renameColumn('city', 'province');
            });
        }

        if (Schema::hasColumn('job_applications', 'town')) {
            Schema::table('job_applications', function (Blueprint $table) {
                $table->renameColumn('town', 'city');
            });
        }

        if (Schema::hasColumn('job_applications', 'suburb')) {
            Schema::table('job_applications', function (Blueprint $table) {
                $table->dropColumn('suburb');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('job_applications', 'province')) {
            Schema::table('job_applications', function (Blueprint $table) {
                $table->renameColumn('province', 'city');
            });
        }

        if (Schema::hasColumn('job_applications', 'city')) {
            Schema::table('job_applications', function (Blueprint $table) {
                $table->renameColumn('city', 'town');
            });
        }

        if (!Schema::hasColumn('job_applications', 'suburb')) {
            Schema::table('job_applications', function (Blueprint $table) {
                $table->string('suburb')->nullable();
            });
        }
    }
};
