<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterandUpdateColumninUserPoint23082021 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `user_points` CHANGE `valid_till` `valid_till` DATE NOT NULL COMMENT 'valid range in months'");
        DB::statement("UPDATE `user_points` SET `valid_till` = '2022-08-16'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
