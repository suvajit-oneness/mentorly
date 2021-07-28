<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBookingStatusToMentorSlotBookedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mentor_slot_bookeds', function (Blueprint $table) {
            //
            $table->bigInteger('bookingStatus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mentor_slot_bookeds', function (Blueprint $table) {
            //
            $table->dropColumn('bookingStatus');
        });
    }
}
