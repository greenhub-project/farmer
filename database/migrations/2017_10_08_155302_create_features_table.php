<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('features', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sample_id');
            $table->string('key', 50);
            $table->string('value');
            $table->timestamps();

            $table->foreign('sample_id')->references('id')->on('samples')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('features');
    }
}
