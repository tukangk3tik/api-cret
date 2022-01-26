<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDnaHasilFamilyHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dna_hasil_family_history', function (Blueprint $table) {
            $table->id();
            $table->integer('pegawai')->nullable();
            $table->date('logged_at')->nullable();
            $table->text('status_awal')->nullable();
            $table->text('status_akhir')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('family', 100)->nullable();
            $table->dateTime('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dna_hasil_family_history');
    }
}
