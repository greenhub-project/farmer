<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMobileMessagesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mobile_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('recipient')->default(0);
            $table->string('type')->default('info');
            $table->string('title');
            $table->text('body');
            $table->boolean('permanent')->default(false);
            $table->boolean('published')->default(false);
            $table->unsignedInteger('version')->default(0);
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
