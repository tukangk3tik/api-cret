<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateGarKutipJenisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garKutipJenis', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('jenisKutip');
        });

        DB::table('garKutipJenis')->insert([
            ["id" => 1, "jenisKutip" => 'Kutip I'],
            ["id" => 2, "jenisKutip" => 'Kutip II'],
            ["id" => 3, "jenisKutip" => 'Kutip III'],
            ["id" => 4, "jenisKutip" => 'Kutip IV'],
            ["id" => 5, "jenisKutip" => 'Kutip V'],
            ["id" => 6, "jenisKutip" => 'Kutip Kch I'],
            ["id" => 7, "jenisKutip" => 'Kutip Kch II']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('garKutipJenis');
    }
}
