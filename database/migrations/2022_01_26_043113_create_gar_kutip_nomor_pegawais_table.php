<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGarKutipNomorPegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garKutipNomorPegawai', function (Blueprint $table) {
            $table->id();
            $table->integer('idGarKutipNomor');
            $table->integer('idPegawai');
            $table->string('nomorKutip', 20);
            $table->dateTime('created_at');
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
        Schema::dropIfExists('garKutipNomorPegawai');
    }
}
