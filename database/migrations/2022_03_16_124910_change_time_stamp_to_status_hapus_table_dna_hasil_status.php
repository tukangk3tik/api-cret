<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeTimeStampToStatusHapusTableDnaHasilStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('dna_hasil_status', 'created_at')) {
            Schema::table('dna_hasil_status', function (Blueprint $table) {
                $table->dropColumn('created_at');
             });
        }

        if (Schema::hasColumn('dna_hasil_status', 'updated_at')) {
            Schema::table('dna_hasil_status', function (Blueprint $table) {
                $table->dropColumn('updated_at');
             });
        }

        if (Schema::hasColumn('dna_hasil_status', 'deleted_at')) {
            Schema::table('dna_hasil_status', function (Blueprint $table) {
                $table->dropColumn('deleted_at');
             });
        }

        if (!Schema::hasColumn('dna_hasil_status', 'status_hapus')) {
            Schema::table('dna_hasil_status', function (Blueprint $table) {
                $table->string('status_hapus', 1)->default('N');
            });
        }

        if (Schema::hasColumn('dna_hasil_status', 'status_hapus')) {
            DB::table('dna_hasil_status')
                ->whereNull('status_hapus')
                ->update(['status_hapus' => 'N']);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dna_hasil_status', function (Blueprint $table) {
            //
        });
    }
}
