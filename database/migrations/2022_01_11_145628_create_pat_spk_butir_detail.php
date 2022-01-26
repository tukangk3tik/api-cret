<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatSpkButirDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pat_spk_butir_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idKantong');
            $table->bigInteger('idKotak');
            $table->integer('jumlahButir')->nullable();
            $table->integer('kantongKe')->nullable();
            $table->bigInteger('idKawinan')->nullable();
            $table->dateTime('used_at')->nullable();
            $table->integer('idSpkTerima')->nullable();
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
        Schema::dropIfExists('pat_spk_butir_detail');
    }
}
