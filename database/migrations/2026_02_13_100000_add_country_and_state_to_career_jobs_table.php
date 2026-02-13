<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $hasCountry = Schema::hasColumn('career_jobs', 'country');
        $hasState = Schema::hasColumn('career_jobs', 'state');

        Schema::table('career_jobs', function (Blueprint $table) use ($hasCountry, $hasState) {
            if (!$hasCountry) {
                $table->string('country')->nullable()->after('description');
            }

            if (!$hasState) {
                $table->string('state')->nullable()->after('country');
            }
        });

        DB::table('career_jobs')
            ->select('id', 'location')
            ->orderBy('id')
            ->chunkById(100, function ($jobs) {
                foreach ($jobs as $job) {
                    $location = trim((string) $job->location);
                    if ($location === '') {
                        continue;
                    }

                    $parts = array_values(array_filter(array_map('trim', explode(',', $location)), fn ($part) => $part !== ''));
                    $country = null;
                    $state = null;

                    if (count($parts) >= 2) {
                        $country = $parts[count($parts) - 1];
                        $state = $parts[count($parts) - 2];
                    } elseif (count($parts) === 1) {
                        $state = $parts[0];
                    }

                    DB::table('career_jobs')
                        ->where('id', $job->id)
                        ->update([
                            'country' => $country,
                            'state' => $state,
                        ]);
                }
            });
    }

    public function down(): void
    {
        $hasState = Schema::hasColumn('career_jobs', 'state');
        $hasCountry = Schema::hasColumn('career_jobs', 'country');

        Schema::table('career_jobs', function (Blueprint $table) use ($hasState, $hasCountry) {
            if ($hasState) {
                $table->dropColumn('state');
            }

            if ($hasCountry) {
                $table->dropColumn('country');
            }
        });
    }
};
