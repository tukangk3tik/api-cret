<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdisolateOtherToPatInoculation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('pat_inoculation', 'idisolate_other')) {
            Schema::table('pat_inoculation', function (Blueprint $table) {
                $table->string('idisolate_other')->nullable()->comment("Id isolate for others trial");
                $table->string('ket')->nullable()->change(); //remove comment
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
        if (Schema::hasColumn('pat_inoculation', 'idisolate_other')) {
            Schema::table('pat_inoculation', function (Blueprint $table) {
                $table->dropColumn('idisolate_other');
            });
        }
    }
}
