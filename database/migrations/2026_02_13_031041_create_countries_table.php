<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('name', 100);
            $table->string('phonecode')->nullable();
            $table->string('currency')->nullable();
        });

        DB::table('countries')->insert([
            ['id' => 1, 'name' => 'Afghanistan', 'phonecode' => '93', 'currency' => 'AFN'],
            ['id' => 2, 'name' => 'Aland Islands', 'phonecode' => '358', 'currency' => 'EUR'],
            ['id' => 3, 'name' => 'Albania', 'phonecode' => '355', 'currency' => 'ALL'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
