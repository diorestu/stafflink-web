<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')->constrained('divisions')->cascadeOnDelete();
            $table->string('name', 190);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['division_id', 'name']);
            $table->index('is_active');
        });

        $divisionIds = DB::table('divisions')->pluck('id', 'name');

        $seedRows = [];
        if (isset($divisionIds['Human Resources'])) {
            $seedRows[] = ['division_id' => $divisionIds['Human Resources'], 'name' => 'HR and Finance Manager', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()];
            $seedRows[] = ['division_id' => $divisionIds['Human Resources'], 'name' => 'HR Officer', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()];
        }
        if (isset($divisionIds['Finance'])) {
            $seedRows[] = ['division_id' => $divisionIds['Finance'], 'name' => 'Finance Officer', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()];
            $seedRows[] = ['division_id' => $divisionIds['Finance'], 'name' => 'Accounting Staff', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()];
        }
        if (isset($divisionIds['Operations'])) {
            $seedRows[] = ['division_id' => $divisionIds['Operations'], 'name' => 'Operations Coordinator', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()];
        }
        if (isset($divisionIds['Marketing'])) {
            $seedRows[] = ['division_id' => $divisionIds['Marketing'], 'name' => 'Marketing Executive', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()];
        }
        if (isset($divisionIds['Sales'])) {
            $seedRows[] = ['division_id' => $divisionIds['Sales'], 'name' => 'Sales Representative', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()];
        }

        if ($seedRows !== []) {
            DB::table('positions')->insert($seedRows);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};
