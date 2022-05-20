<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKchInitialToGarKutipNomorPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('garKutipNomorPegawai', 'kch_initial')) {
            Schema::table('garKutipNomorPegawai', function (Blueprint $table) {
                $table->boolean('kch_initial')->default(false)->after('nomorKutip');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('garKutipNomorPegawai', 'kch_initial')) {
            Schema::table('garKutipNomorPegawai', function (Blueprint $table) {
                $table->dropColumn('kch_initial');
            });
        }
    }
}
