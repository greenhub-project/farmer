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
            $table->unsignedInteger('device_id');
            $table->timestamp('timestamp');
            $table->unsignedInteger('app_version')->default(0);
            $table->unsignedInteger('database_version')->default(0);
            $table->string('battery_state', 20);
            $table->decimal('battery_level');
            $table->unsignedInteger('memory_active');
            $table->unsignedInteger('memory_inactive');
            $table->unsignedInteger('memory_free');
            $table->unsignedInteger('memory_user');
            $table->string('triggered_by', 100);
            $table->string('network_status', 50);
            $table->integer('screen_brightness');
            $table->boolean('screen_on');
            $table->string('timezone', 50);
            $table->string('country_code', 10);
            $table->timestamps();

            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');

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
