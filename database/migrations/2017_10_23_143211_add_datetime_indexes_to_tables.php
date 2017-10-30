<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatetimeIndexesToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->index('created_at');
        });
        Schema::table('samples', function (Blueprint $table) {
            $table->index('created_at');
        });
        Schema::table('app_processes', function (Blueprint $table) {
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->dropIndex('created_at');
        });
        Schema::table('samples', function (Blueprint $table) {
            $table->dropIndex('created_at');
        });
        Schema::table('app_processes', function (Blueprint $table) {
            $table->dropIndex('created_at');
        });
    }
}
