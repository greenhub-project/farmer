<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSamplesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('device_id')->unsigned();
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
            $table->timestamp('timestamp');
            $table->integer('app_version')->unsigned()->default(0);
            $table->integer('database_version')->unsigned()->default(0);
            $table->string('battery_state', 20);
            $table->decimal('battery_level');
            $table->integer('memory_wired');
            $table->integer('memory_active');
            $table->integer('memory_inactive');
            $table->integer('memory_free');
            $table->integer('memory_user');
            $table->string('triggered_by', 80);
            $table->string('network_status', 50);
            $table->integer('screen_brightness');
            $table->boolean('screen_on');
            $table->string('timezone', 50);
            $table->string('country_code', 10);
            $table->timestamps();

            $table->index('battery_state');
            $table->index('network_status');
            $table->index('screen_on');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('samples');
    }
}
