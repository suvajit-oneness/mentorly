<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageToMentorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_to_mentors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mentorId');
            $table->bigInteger('userId')->comment('it Holds only the Mentee Id i.e user table Id');
            $table->string('mentorOrMentee')->comment('Mentor or Mentee strore the Id of Authenticated User according to the Guard');
            $table->longText('message');
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
        Schema::dropIfExists('message_to_mentors');
    }
}
