<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCpuStatusesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cpu_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sample_id')->unsigned();
            $table->foreign('sample_id')->references('id')->on('samples')->onDelete('cascade');
            $table->decimal('usage');
            $table->bigInteger('up_time')->unsigned()->default(0);
            $table->bigInteger('sleep_time')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('cpu_statuses');
    }
}
