<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mentorId');
            $table->bigInteger('menteeId');
            $table->enum('userType',['web','mentor','admin']);
            $table->string('uuid');
            $table->bigInteger('meetingId');
            $table->string('host_id');
            $table->string('host_email');
            $table->string('topic');
            $table->string('start_time');
            $table->string('agenda');
            $table->string('join_url');
            $table->string('password');
            $table->string('encrypted_password');
            $table->string('status');
            $table->string('type');
            $table->longText('start_url');
            $table->string('remark');
            $table->tinyInteger('over')->comment('1:Meeting Over, 0: Not Done');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zoom_meetings');
    }
}
