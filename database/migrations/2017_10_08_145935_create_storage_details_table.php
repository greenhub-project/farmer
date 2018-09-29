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
            $table->integer('sample_id')->unsigned();
            $table->foreign('sample_id')->references('id')->on('samples')->onDelete('cascade');
            $table->integer('free')->unsigned();
            $table->integer('total')->unsigned();
            $table->integer('free_external')->unsigned();
            $table->integer('total_external')->unsigned();
            $table->integer('free_system')->unsigned();
            $table->integer('total_system')->unsigned();
            $table->integer('free_secondary')->unsigned();
            $table->integer('total_secondary')->unsigned();
            $table->timestamps();
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
