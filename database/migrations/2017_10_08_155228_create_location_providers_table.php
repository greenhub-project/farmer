<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationProvidersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('location_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sample_id')->unsigned();
            $table->foreign('sample_id')->references('id')->on('samples')->onDelete('cascade');
            $table->string('provider', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('location_providers');
    }
}
