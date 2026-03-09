<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_inquiries', function (Blueprint $table): void {
            $table->id();
            $table->string('name', 120);
            $table->string('email', 190);
            $table->string('phone', 50);
            $table->string('company_name', 190);
            $table->string('company_size', 50);
            $table->string('preferred_call_time', 50)->nullable();
            $table->date('preferred_call_date')->nullable();
            $table->text('message')->nullable();
            $table->string('submitted_from_ip', 45)->nullable();
            $table->text('submitted_user_agent')->nullable();
            $table->timestamps();

            $table->index(['created_at']);
            $table->index(['email']);
            $table->index(['company_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_inquiries');
    }
};
