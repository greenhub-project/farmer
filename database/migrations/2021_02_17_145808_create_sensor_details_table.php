<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sensor_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sample_id');
            $table->integer('fifo_max_event_count');
            $table->integer('fifo_reserved_event_count');
            $table->integer('highest_direct_report_rate_level');
            $table->boolean('is_additional_info_supported');
            $table->boolean('is_dynamic_sensor');
            $table->boolean('is_wake_up_sensor');
            $table->integer('max_delay');
            $table->decimal('maximum_range');
            $table->integer('min_delay');
            $table->string('name', 100);
            $table->double('power');            
            $table->integer('reporting_mode');
            $table->decimal('resolution');  
            $table->string('string_type', 100);            
            $table->integer('code_type');  
            $table->string('vendor', 50);            
            $table->integer('version');            
            $table->integer('frequency_of_use'); 
            $table->bigInteger('ini_timestamp'); 
            $table->bigInteger('end_timestamp');
            $table->timestamps();

            $table->foreign('sample_id')->references('id')->on('samples')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('sensor_details');
    }
}
