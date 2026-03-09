<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('wedding_events', function (Blueprint $table): void {
            $table->string('unique_code', 40)->nullable()->after('couple_names')->unique();
        });

        Schema::table('nanny_inquiries', function (Blueprint $table): void {
            $table->string('unique_code', 40)->nullable()->after('wedding_couple_names')->index();
        });
    }

    public function down(): void
    {
        Schema::table('nanny_inquiries', function (Blueprint $table): void {
            $table->dropIndex(['unique_code']);
            $table->dropColumn('unique_code');
        });

        Schema::table('wedding_events', function (Blueprint $table): void {
            $table->dropUnique(['unique_code']);
            $table->dropColumn('unique_code');
        });
    }
};
