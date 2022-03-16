<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDnaHasilStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dna_hasil_status', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('nama');
            $table->string('status_hapus', 1)->default('N');
        });

        DB::table('dna_hasil_status')->insert([
            ['nama' => 'Legitimate'],
            ['nama' => 'Illegitimate'],
            ['nama' => 'Doubtful'],
            ['nama' => 'Missing Parents'],
            ['nama' => 'Incomplete Genotype'],
            ['nama' => 'Missing Parent'],
            ['nama' => 'Check Needed'],
            ['nama' => 'Not Decided Yet'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dna_hasil_status');
    }
}
