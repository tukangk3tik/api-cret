<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatNurseriesCrossRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pat_nurseries_cross_record', function (Blueprint $table) {
            $table->id();
            $table->integer('id_nurseries');
            $table->integer('latest_standard_cross')->nullable();
            $table->integer('latest_all_cross')->nullable();
            $table->integer('latest_persen_c1')->nullable();
            $table->integer('latest_persen_c2')->nullable();
            $table->integer('latest_persen_c3')->nullable();
            $table->string('jenis', 5)-> nullable();
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pat_nurseries_cross_record');
    }
}
