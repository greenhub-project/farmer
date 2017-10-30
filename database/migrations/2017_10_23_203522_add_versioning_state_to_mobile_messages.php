<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVersioningStateToMobileMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mobile_messages', function (Blueprint $table) {
            $table->integer('version')->unsigned()->default(0);
            $table->boolean('permanent')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mobile_messages', function (Blueprint $table) {
            $table->dropColumn(['version', 'permanent']);
        });
    }
}
