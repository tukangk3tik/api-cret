<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQcStaffUnionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qc_staff_unions', function (Blueprint $table) {
            $table->id();
            $table->integer('id_treefile');
            $table->string('table_production', 20);
            $table->integer('id_production');
            $table->integer('jenis_qc');
            $table->string('table_qc', 20);
            $table->integer('id_qc');
            $table->string('kode_pekerja', 10)->nullable();
            $table->string('kode_mandor', 10)->nullable();
            $table->tinyInteger('label_sungkup')->nullable();
            $table->tinyInteger('label_mantri_sungkup')->nullable();
            $table->tinyInteger('label_polen')->nullable();
            $table->tinyInteger('label_mantri_kawinan')->nullable();
            $table->integer('jlh_janjang')->nullable();
            $table->text('keterangan')->nullable();
            $table->date('tgl_input');
            $table->string('kode_staff', 10);
            $table->string('kode_unit', 5);
            $table->dateTime('last_sync');
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
        Schema::dropIfExists('qc_staff_unions');
    }
}
