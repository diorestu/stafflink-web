<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120)->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('divisions')->insert([
            ['name' => 'Human Resources', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Finance', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Operations', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Marketing', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sales', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('divisions');
    }
};
