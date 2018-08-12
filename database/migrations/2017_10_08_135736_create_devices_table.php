<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid', 120);
            $table->string('model', 50);
            $table->string('manufacturer', 50);
            $table->string('brand', 50);
            $table->string('product', 50);
            $table->string('os_version', 50);
            $table->string('kernel_version', 100);
            $table->boolean('is_root');
            $table->timestamps();

            $table->index('uuid');
            $table->index('model');
            $table->index('brand');
            $table->index('os_version');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
