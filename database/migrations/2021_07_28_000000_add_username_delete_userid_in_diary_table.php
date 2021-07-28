<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsernameDeleteUseridInDiaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diary', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'date']);
            $table->dropColumn(['user_id']);
            $table->string('aws_username')->after('id');
            $table->unique(['aws_username', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diary', function (Blueprint $table) {
            $table->dropUnique(['aws_username', 'date']);
            $table->dropColumn(['aws_username']);
            $table->bigInteger('user_id')->after('id');
            $table->unique(['user_id', 'date']);
        });
    }
}
