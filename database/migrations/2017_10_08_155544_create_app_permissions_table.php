<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('android_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('permission');
            $table->timestamps();
        });

        Schema::create('app_permissions', function (Blueprint $table) {
            $table->unsignedInteger('android_permission_id');
            $table->unsignedInteger('app_process_id');
            $table->timestamps();

            $table->foreign('android_permission_id')->references('id')->on('android_permissions')->onDelete('cascade');
            $table->foreign('app_process_id')->references('id')->on('app_processes')->onDelete('cascade');
            $table->primary(['android_permission_id', 'app_process_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('app_permissions');
        Schema::dropIfExists('android_permissions');
    }
}
