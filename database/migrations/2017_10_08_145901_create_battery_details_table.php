<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatteryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('battery_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sample_id')->unsigned();
            $table->foreign('sample_id')->references('id')->on('samples')->onDelete('cascade');
            $table->string('charger', 20);
            $table->string('health', 30);
            $table->decimal('voltage');
            $table->decimal('temperature');
            $table->integer('capacity');
            $table->integer('charge_counter');
            $table->integer('current_average');
            $table->integer('current_now');
            $table->bigInteger('energy_counter');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('battery_details');
    }
}
