<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobileMessagesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mobile_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recipient')->unsigned()->default(0);
            $table->string('type')->default('info');
            $table->string('title');
            $table->text('body');
            $table->timestamps();

            $table->index('recipient');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('mobile_messages');
    }
}
