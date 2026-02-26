<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_areas', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('slug')->unique();
            $table->string('type')->default('state');
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('seo_label')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['is_active', 'sort_order']);
        });

        $defaults = [
            'Canggu',
            'Seminyak',
            'Kuta',
            'Jimbaran',
            'Uluwatu',
            'Denpasar',
            'Tabanan',
            'Ubud',
            'Bedugul',
            'Ungasan',
        ];

        $now = now();

        $rows = collect($defaults)->values()->map(function (string $label, int $index) use ($now): array {
            return [
                'label' => $label,
                'slug' => Str::slug($label),
                'type' => 'state',
                'state' => $label,
                'country' => null,
                'seo_label' => $label,
                'sort_order' => $index + 1,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        })->all();

        DB::table('service_areas')->insert($rows);
    }

    public function down(): void
    {
        Schema::dropIfExists('service_areas');
    }
};
