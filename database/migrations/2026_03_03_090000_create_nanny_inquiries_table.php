<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('nanny_inquiries', function (Blueprint $table): void {
            $table->id();
            $table->string('guardian_name', 120);
            $table->string('guardian_phone', 50);
            $table->string('guardian_email', 190)->index();
            $table->string('children_count', 10);
            $table->json('children')->nullable();
            $table->string('accommodation_location_option', 20);
            $table->text('accommodation_detail')->nullable();
            $table->string('ceremony_service_choice', 10);
            $table->text('additional_hours');
            $table->string('payment_acknowledgement', 30);
            $table->text('whatsapp_message')->nullable();
            $table->string('submitted_from_ip', 45)->nullable();
            $table->text('submitted_user_agent')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nanny_inquiries');
    }
};
