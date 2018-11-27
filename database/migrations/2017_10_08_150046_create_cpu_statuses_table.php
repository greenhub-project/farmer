<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCpuStatusesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cpu_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sample_id');
            $table->decimal('usage');
            $table->unsignedBigInteger('up_time')->default(0);
            $table->unsignedBigInteger('sleep_time')->default(0);
            $table->timestamps();

            $table->foreign('sample_id')->references('id')->on('samples')->onDelete('cascade');
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
