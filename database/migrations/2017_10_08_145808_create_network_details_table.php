<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetworkDetailsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('network_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sample_id');
            $table->string('network_type', 30);
            $table->string('mobile_network_type', 20);
            $table->string('mobile_data_status', 20);
            $table->string('mobile_data_activity', 10);
            $table->boolean('roaming_enabled');
            $table->string('wifi_status', 20);
            $table->integer('wifi_signal_strength');
            $table->integer('wifi_link_speed');
            $table->string('wifi_ap_status', 20);
            $table->string('network_operator')->nullable();
            $table->string('sim_operator')->nullable();
            $table->string('mcc', 10);
            $table->string('mnc', 10);
            $table->timestamps();

            $table->foreign('sample_id')->references('id')->on('samples')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('network_details');
    }
}
