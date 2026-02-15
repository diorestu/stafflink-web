<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_category_id')->constrained('career_categories')->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->string('location')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('type')->default('full-time');
            $table->string('salary_range')->nullable();
            $table->unsignedBigInteger('minimum_salary')->nullable();
            $table->unsignedBigInteger('maximum_salary')->nullable();
            $table->string('status')->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
