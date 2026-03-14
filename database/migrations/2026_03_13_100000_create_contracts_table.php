<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('contract_number', 80)->unique();
            $table->string('template', 30);
            $table->string('employee_name', 190);
            $table->string('employee_title', 10)->nullable();
            $table->string('employee_id_number', 80)->nullable();
            $table->string('position_title', 190);
            $table->string('employment_basis', 120)->nullable();
            $table->string('company_name', 190);
            $table->string('employer_name', 190)->nullable();
            $table->string('first_party_name', 190)->nullable();
            $table->date('agreement_date');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('salary_total', 15, 0)->default(0);
            $table->decimal('salary_base', 15, 0)->nullable();
            $table->decimal('salary_allowance', 15, 0)->nullable();
            $table->decimal('food_allowance', 15, 0)->nullable();
            $table->json('form_data');
            $table->timestamps();

            $table->index('template');
            $table->index('employee_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
