<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatNurseriesInfectionReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pat_nurseries_infection_report', function (Blueprint $table) {
            $table->id();
            $table->integer('id_progenie');
            $table->integer('id_nurseries');
            $table->string('progenies', 5);

            $table->integer('r1_gano')->nullable();
            $table->integer('r1_inoc')->nullable();
            $table->integer('r1_persen')->nullable();

            $table->integer('r2_gano')->nullable();
            $table->integer('r2_inoc')->nullable();
            $table->integer('r2_persen')->nullable();

            $table->integer('r3_gano')->nullable();
            $table->integer('r3_inoc')->nullable();
            $table->integer('r3_persen')->nullable();

            $table->integer('r4_gano')->nullable();
            $table->integer('r4_inoc')->nullable();
            $table->integer('r4_persen')->nullable();

            $table->integer('r5_gano')->nullable();
            $table->integer('r5_inoc')->nullable();
            $table->integer('r5_persen')->nullable();

            $table->integer('total_gano')->nullable();
            $table->integer('total_inoc')->nullable();
            $table->integer('total_persen')->nullable();
            $table->integer('index_all')->nullable();

            $table->float('c1_persen', 8, 3)->nullable();
            $table->float('c2_persen', 8, 3)->nullable();
            $table->float('c3_persen', 8, 3)->nullable();

            $table->float('total_cross', 8, 3)->nullable();
            $table->string('jenis', 5)->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pat_nurseries_infection_report');
    }
}
