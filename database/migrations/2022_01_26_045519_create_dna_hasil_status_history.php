<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDnaHasilStatusHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dna_hasil_status_history', function (Blueprint $table) {
            $table->id();
            $table->date('logged_at');
            $table->integer('id_pegawai');
            $table->text('keterangan')->nullable();
            $table->string('status_awal', 100)->nullable();
            $table->string('status_akhir', 100)->nullable();
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
        Schema::dropIfExists('dna_hasil_status_history');
    }
}
