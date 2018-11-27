<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStorageDetailsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('storage_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sample_id');
            $table->unsignedInteger('free');
            $table->unsignedInteger('total');
            $table->unsignedInteger('free_external');
            $table->unsignedInteger('total_external');
            $table->unsignedInteger('free_system');
            $table->unsignedInteger('total_system');
            $table->unsignedInteger('free_secondary');
            $table->unsignedInteger('total_secondary');
            $table->timestamps();

            $table->foreign('sample_id')->references('id')->on('samples')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('storage_details');
    }
}
