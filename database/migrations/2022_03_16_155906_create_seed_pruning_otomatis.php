<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeedPruningOtomatis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seed_pruning_otomatis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_treefile')->nullable();
            $table->date('pruning_jadwal')->nullable();
            $table->date('pruning_realisasi')->nullable();
            $table->text('pruning_keterangan')->nullable();
            $table->date('double_pruning_jadwal')->nullable();
            $table->date('double_pruning_realisasi')->nullable();
            $table->text('double_pruning_keterangan')->nullable();
            $table->integer('pruning_ke')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seed_pruning_otomatis');
    }
}
