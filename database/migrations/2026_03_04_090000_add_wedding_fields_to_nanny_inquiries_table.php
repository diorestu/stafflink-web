<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('nanny_inquiries', function (Blueprint $table): void {
            $table->string('wedding_couple_names', 190)->nullable()->after('id');
            $table->date('wedding_date')->nullable()->after('wedding_couple_names');
            $table->string('wedding_start_time', 10)->nullable()->after('wedding_date');
            $table->text('wedding_location_address')->nullable()->after('wedding_start_time');
            $table->string('wedding_venue_name', 190)->nullable()->after('wedding_location_address');
            $table->string('wedding_group_key', 64)->nullable()->after('wedding_venue_name')->index();
            $table->string('nannies_required', 10)->nullable()->after('children_count');
        });
    }

    public function down(): void
    {
        Schema::table('nanny_inquiries', function (Blueprint $table): void {
            $table->dropIndex(['wedding_group_key']);
            $table->dropColumn([
                'wedding_couple_names',
                'wedding_date',
                'wedding_start_time',
                'wedding_location_address',
                'wedding_venue_name',
                'wedding_group_key',
                'nannies_required',
            ]);
        });
    }
};
