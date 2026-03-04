<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('service_areas')) {
            return;
        }

        $labels = [
            'Amed',
            'Lovina',
            'Nusa Penida',
            'Nusa Lembongan',
        ];

        $nextSortOrder = (int) (DB::table('service_areas')->max('sort_order') ?? 0);
        $now = now();

        foreach ($labels as $label) {
            $slug = Str::slug($label);

            $exists = DB::table('service_areas')
                ->where('slug', $slug)
                ->exists();

            if ($exists) {
                continue;
            }

            $nextSortOrder++;

            DB::table('service_areas')->insert([
                'label' => $label,
                'slug' => $slug,
                'type' => 'state',
                'state' => $label,
                'country' => null,
                'seo_label' => $label,
                'sort_order' => $nextSortOrder,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('service_areas')) {
            return;
        }

        DB::table('service_areas')
            ->whereIn('slug', [
                'amed',
                'lovina',
                'nusa-penida',
                'nusa-lembongan',
            ])
            ->delete();
    }
};
