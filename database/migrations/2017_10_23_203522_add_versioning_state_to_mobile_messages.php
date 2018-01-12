<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVersioningStateToMobileMessages extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('mobile_messages', function (Blueprint $table) {
            $table->boolean('permanent')->default(false);
            $table->boolean('published')->default(false);
            $table->integer('version')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('mobile_messages', function (Blueprint $table) {
            $table->dropColumn(['permanent', 'published', 'version']);
        });
    }
}
