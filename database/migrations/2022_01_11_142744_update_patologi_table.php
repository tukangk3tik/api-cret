<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePatologiTable extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pat_inoculation', function (Blueprint $table) {
            $table->integer('jenis_trial')->nullable();
            //$table->string('idisolate')->nullable()->change(); //manual update
        });

        Schema::table('pat_inoculation_det', function (Blueprint $table) {
            $table->integer('idisolate')->nullable();
        });

        Schema::table('pat_inoculation_observation', function (Blueprint $table) {
            $table->date('next_observation')->nullable();
        });

        Schema::table('pat_nurseries', function (Blueprint $table) {
            $table->integer('idSpkTerima')->nullable();
            $table->integer('jenis_trial')->nullable();
            $table->integer('jlh_treatment')->nullable();
        });

        Schema::table('pat_nurseries_observation', function (Blueprint $table) {
            $table->string('standard_cross', 50)->nullable();
            $table->string('all_cross', 50)->nullable();
            $table->date('next_observation')->nullable();
            $table->string('c1_result', 50)->nullable();
            $table->string('c2_result', 50)->nullable();
            $table->string('c3_result', 50)->nullable();
        });

        Schema::table('pat_proganies', function (Blueprint $table) {
            $table->integer('id_spk_detail')->nullable();
            $table->integer('treatment')->nullable();
            $table->integer('idisolate')->nullable();
        });

        Schema::table('pat_staff', function (Blueprint $table) {
            $table->integer('id_master')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pat_inoculation', function (Blueprint $table) {
            $table->dropColumn('jenis_trial');
            //$table->dropColumn('idisolate');
        });

        Schema::table('pat_inoculation_det', function (Blueprint $table) {
            $table->dropColumn('idisolate');
        });

        Schema::table('pat_inoculation_observation', function (Blueprint $table) {
            $table->dropColumn('next_observation');
        });

        Schema::table('pat_nurseries', function (Blueprint $table) {
            $table->dropColumn('idSpkTerima');
            $table->dropColumn('jenis_trial');
            $table->dropColumn('jlh_treatment');
        });

        Schema::table('pat_nurseries_observation', function (Blueprint $table) {
            $table->dropColumn('standard_cross');
            $table->dropColumn('all_cross');
            $table->dropColumn('next_observation');
            $table->dropColumn('c1_result');
            $table->dropColumn('c2_result');
            $table->dropColumn('c3_result');
        });

        Schema::table('pat_proganies', function (Blueprint $table) {
            $table->dropColumn('id_spk_detail');
            $table->dropColumn('treatment');
            $table->dropColumn('idisolate');
        });

        Schema::table('pat_staff', function (Blueprint $table) {
            $table->dropColumn('id_master');
        });

    }
}
