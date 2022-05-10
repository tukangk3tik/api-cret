<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentToKetInPatInoculation extends Migration
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
                $table->string('ket')->nullable()->comment("Id isolate for others trial")->change();
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
        //
    }
}
