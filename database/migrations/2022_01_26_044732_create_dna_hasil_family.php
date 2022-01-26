<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDnaHasilFamily extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dna_hasil_family', function (Blueprint $table) {
            $table->id();
            $table->string('family', 100)->nullable();
            $table->bigInteger('legitime')->nullable();
            $table->bigInteger('illegitime')->nullable();
            $table->dateTime('waktu_input')->nullable();
            $table->string('decision', 1)->nullable();
            $table->string('allow_seed_production', 1)->nullable();
            $table->string('allow_breeding', 1)->nullable();
            $table->string('status_hapus', 1)->default('N')->nullable();
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
        Schema::dropIfExists('dna_hasil_family');
    }
}
