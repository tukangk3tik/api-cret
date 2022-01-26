<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatSpkTerima extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pat_spk_terima', function (Blueprint $table) {
            $table->id();
            $table->integer('idSurat');
            $table->string('noSurat', 50);
            $table->date('tanggalKirim');
            $table->dateTime('waktuTerima');
            $table->integer('idPegawai');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pat_spk_terima');
    }
}
