<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentorExperienceLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentor_experience_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mentorId');
            $table->date('start');
            $table->date('end');
            $table->tinyInteger('type')->comment('1: Education, 2: Work')->default(2);
            $table->string('name');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        $mentors = \App\Models\Mentor::get();
        $experience = [];
        foreach ($mentors as $key => $mentor) {
            $experience[] = [
                'mentorId' => $mentor->id,
                'start' => date('Y-m-d',strtotime('-5 year')),
                'end' => date('Y-m-d',strtotime('-2 year')),
                'type' => rand(1,2),
                'name' => 'Kwansei Gakuin University Integrated Psychological Sciences',
            ];
            $experience[] = [
                'mentorId' => $mentor->id,
                'start' => date('Y-m-d',strtotime('-2 year')),
                'end' => date('Y-m-d'),
                'type' => rand(1,2),
                'name' => 'West Bengal University of Technology',
            ];
        }
        DB::table('mentor_experience_logs')->insert($experience);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mentor_experience_logs');
    }
}
