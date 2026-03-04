<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('wedding_events', function (Blueprint $table): void {
            $table->id();
            $table->string('couple_names', 190);
            $table->date('wedding_date')->index();
            $table->string('wedding_start_time', 10);
            $table->text('wedding_location_address');
            $table->string('wedding_venue_name', 190)->nullable();
            $table->string('share_token', 80)->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wedding_events');
    }
};

