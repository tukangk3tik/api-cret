<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKchCouplerToGarKutipNomor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('garKutipNomor', 'kch_coupler')) {
            Schema::table('garKutipNomor', function (Blueprint $table) {
                $table->string('kch_coupler', 20)->comment('coupler for kutip 1 -> kch 1; kutip 2 -> kch 2')->nullable();
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
        if (Schema::hasColumn('garKutipNomor', 'kch_coupler')) {
            Schema::table('garKutipNomor', function (Blueprint $table) {
                $table->dropColumn('kch_coupler');
            });
        }
    }
}
