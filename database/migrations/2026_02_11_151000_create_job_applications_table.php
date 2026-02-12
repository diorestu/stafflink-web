<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->unsignedTinyInteger('age');
            $table->string('religion');
            $table->string('city');
            $table->string('town')->nullable();
            $table->string('suburb')->nullable();
            $table->boolean('speaks_english');
            $table->string('english_level')->nullable();
            $table->boolean('willing_to_travel');
            $table->boolean('has_motorbike');
            $table->boolean('has_passport');
            $table->boolean('can_drive_car');
            $table->string('position_title');
            $table->string('resume_path');
            $table->string('status', 30)->default('new');
            $table->timestamps();

            $table->index('status');
            $table->index('position_title');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
