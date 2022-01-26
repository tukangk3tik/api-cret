<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGarKutipNomorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garKutipNomor', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tglPembuatan');
            $table->integer('idProduksi');
            $table->integer('idJenisKutip');
            $table->string('kode_unit', 5);
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
        Schema::dropIfExists('garKutipNomor');
    }
}
