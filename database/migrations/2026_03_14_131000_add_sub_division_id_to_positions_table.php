<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('positions', function (Blueprint $table) {
            if (! Schema::hasColumn('positions', 'sub_division_id')) {
                $table->foreignId('sub_division_id')
                    ->nullable()
                    ->after('division_id')
                    ->constrained('sub_divisions')
                    ->nullOnDelete();
                $table->index('sub_division_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('positions', function (Blueprint $table) {
            if (Schema::hasColumn('positions', 'sub_division_id')) {
                $table->dropConstrainedForeignId('sub_division_id');
            }
        });
    }
};
