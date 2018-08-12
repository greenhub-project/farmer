<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('app_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_process_id')->unsigned();
            $table->foreign('app_process_id')->references('id')->on('app_processes')->onDelete('cascade');
            $table->string('permission', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('app_permissions');
    }
}
