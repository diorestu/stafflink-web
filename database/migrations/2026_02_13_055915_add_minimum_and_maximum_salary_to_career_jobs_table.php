<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('career_jobs', function (Blueprint $table) {
            if (!Schema::hasColumn('career_jobs', 'minimum_salary')) {
                $table->unsignedBigInteger('minimum_salary')->nullable()->after('type');
            }

            if (!Schema::hasColumn('career_jobs', 'maximum_salary')) {
                $table->unsignedBigInteger('maximum_salary')->nullable()->after('minimum_salary');
            }
        });

        DB::table('career_jobs')
            ->select('id', 'salary_range')
            ->orderBy('id')
            ->chunkById(100, function ($jobs): void {
                foreach ($jobs as $job) {
                    $range = (string) ($job->salary_range ?? '');
                    preg_match_all('/[\d,.]+/', $range, $matches);
                    $numbers = collect($matches[0] ?? [])
                        ->map(fn (string $value) => (int) preg_replace('/[^\d]/', '', $value))
                        ->filter(fn (int $value) => $value > 0)
                        ->values();

                    if ($numbers->count() === 0) {
                        continue;
                    }

                    $min = (int) $numbers->first();
                    $max = (int) ($numbers->count() > 1 ? $numbers->get(1) : $min);

                    if ($max < $min) {
                        [$min, $max] = [$max, $min];
                    }

                    DB::table('career_jobs')
                        ->where('id', $job->id)
                        ->update([
                            'minimum_salary' => $min,
                            'maximum_salary' => $max,
                        ]);
                }
            });
    }

    public function down(): void
    {
        Schema::table('career_jobs', function (Blueprint $table) {
            if (Schema::hasColumn('career_jobs', 'maximum_salary')) {
                $table->dropColumn('maximum_salary');
            }

            if (Schema::hasColumn('career_jobs', 'minimum_salary')) {
                $table->dropColumn('minimum_salary');
            }
        });
    }
};
