<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatScheduleTrial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pat_schedule_trial', function (Blueprint $table) {
            $table->id();
            $table->string('trial', 50);
            $table->string('objective_trial', 255);
            $table->string('source_gs', 100);
            $table->string('treatment', 50);
            $table->date('culture_room_schedule');
            $table->date('prenursery_schedule');
            $table->date('final_result_schedule');
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
        Schema::dropIfExists('pat_schedule_trial');
    }
}
