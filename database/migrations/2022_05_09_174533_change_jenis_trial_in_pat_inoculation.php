<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeJenisTrialInPatInoculation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('pat_inoculation', 'jenis_trial')) {
            Schema::table('pat_inoculation', function (Blueprint $table) {
                $table->integer('jenis_trial')->nullable()->default(1)->change();
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
        if (Schema::hasColumn('pat_inoculation', 'jenis_trial')) {
            Schema::table('pat_inoculation', function (Blueprint $table) {
                $table->integer('jenis_trial')->nullable()->change();
            });
        }
    }
}
