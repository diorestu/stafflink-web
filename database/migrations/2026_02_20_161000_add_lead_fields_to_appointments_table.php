<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table): void {
            $table->string('lead_status', 20)->default('new')->after('status');
            $table->text('lead_notes')->nullable()->after('lead_status');
            $table->index('lead_status');
        });

        DB::table('appointments')
            ->whereNull('lead_status')
            ->update(['lead_status' => 'new']);
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table): void {
            $table->dropIndex(['lead_status']);
            $table->dropColumn(['lead_status', 'lead_notes']);
        });
    }
};

