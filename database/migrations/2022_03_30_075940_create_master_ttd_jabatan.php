<?php

use App\Models\MasterTtdJabatan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterTtdJabatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_ttd_jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('jabatan');
            $table->integer('id_pegawai')->nullable();
            $table->string('kode_unit', 5);
            $table->timestamps();

            $table->foreign('id_pegawai')->references('id')->on('master_pegawai');
        });

        $data = [
            ['Pjs Kep. SSP & Labs', 'BB'],
            ['Staff Int. Audit Group', 'BB'],
            ['Staff Laboratorium', 'BB'],
            ['Petugas LBK', 'BB'],
            ['Petugas Germ', 'BB'],
        ];

        foreach ($data as $key => $value) {
            MasterTtdJabatan::create([
                'jabatan' => $value[0],
                'kode_unit' => $value[1]
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_ttd_jabatan');
    }
}
