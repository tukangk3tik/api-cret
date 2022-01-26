<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatScreeningOther extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pat_screening_other', function (Blueprint $table) {
            $table->id();
            $table->integer('idnurseri');
            $table->string('trial', 50)->nullable();
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();

            $table->string('nurserypaper', 30)->nullable();
            $table->string('progenie', 30)->nullable();
            $table->string('polinasi', 30)->nullable();

            $table->integer('seeds')->nullable();
            $table->date('tglkirim')->nullable();


            $table->string('family', 50)->nullable();
            $table->string('categori', 50)->nullable();
            $table->string('genitorfemale', 50)->nullable();
            $table->string('genitormale', 50)->nullable();
            $table->string('familyfemale', 50)->nullable();
            $table->string('familymale', 50)->nullable();
            $table->string('originfemale', 50)->nullable();
            $table->string('originmale', 50)->nullable();
            $table->string('program', 50)->nullable();
            $table->string('ket', 255)->nullable();
            $table->string('status', 30)->nullable();

            $table->decimal('persenserangan', 5, 1)->nullable();
            $table->integer('weeksend')->nullable();
            $table->integer('indexes')->nullable();
            $table->integer('indexis')->nullable();

            $table->integer('idisolate')->nullable();
            $table->integer('treatment')->nullable();
            
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
        Schema::dropIfExists('pat_screening_other');
    }
}
