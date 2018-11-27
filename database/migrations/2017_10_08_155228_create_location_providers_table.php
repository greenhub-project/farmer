<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationProvidersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('location_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sample_id');
            $table->string('provider', 20);
            $table->timestamps();

            $table->foreign('sample_id')->references('id')->on('samples')->onDelete('cascade');
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
