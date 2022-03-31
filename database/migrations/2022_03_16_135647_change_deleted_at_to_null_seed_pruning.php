<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDeletedAtToNullSeedPruning extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('seed_pruning', 'deleted_at')) {
            Schema::table('seed_pruning', function (Blueprint $table) {
                $table->dateTime('deleted_at')->nullable()->change();
            });
        }

        if (Schema::hasColumn('seed_pruning', 'updated_at')) {
            Schema::table('seed_pruning', function (Blueprint $table) {
                $table->dateTime('updated_at')->nullable()->change();
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
        Schema::table('seed_pruning', function (Blueprint $table) {
            //
        });
    }
}
