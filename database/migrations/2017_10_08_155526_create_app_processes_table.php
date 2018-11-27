<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppProcessesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('app_processes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sample_id');
            $table->unsignedInteger('process_id');
            $table->string('name');
            $table->string('application_label')->nullable();
            $table->boolean('is_system_app');
            $table->string('importance', 20)->nullable();
            $table->string('version_name', 100)->nullable();
            $table->integer('version_code');
            $table->string('installation_package')->nullable();
            $table->timestamps();

            $table->foreign('sample_id')->references('id')->on('samples')->onDelete('cascade');

            $table->index('name');
            $table->index('application_label');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('app_processes');
    }
}
