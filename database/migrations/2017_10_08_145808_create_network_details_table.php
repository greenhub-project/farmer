<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetworkDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('network_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sample_id')->unsigned();
            $table->foreign('sample_id')->references('id')->on('samples')->onDelete('cascade');
            $table->string('network_type', 20);
            $table->string('mobile_network_type', 20);
            $table->string('mobile_data_status', 20);
            $table->string('mobile_data_activity', 10);
            $table->boolean('roaming_enabled');
            $table->string('wifi_status', 20);
            $table->integer('wifi_signal_strength');
            $table->integer('wifi_link_speed');
            $table->string('wifi_ap_status', 20);
            $table->string('network_operator', 50);
            $table->string('sim_operator', 50);
            $table->string('mcc', 10);
            $table->string('mnc', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('network_details');
    }
}
