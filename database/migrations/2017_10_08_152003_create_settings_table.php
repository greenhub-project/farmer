<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sample_id');
            $table->boolean('bluetooth_enabled');
            $table->boolean('location_enabled');
            $table->boolean('power_saver_enabled');
            $table->boolean('flashlight_enabled');
            $table->boolean('nfc_enabled');
            $table->boolean('unknown_sources');
            $table->boolean('developer_mode');
            $table->timestamps();

            $table->foreign('sample_id')->references('id')->on('samples')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
