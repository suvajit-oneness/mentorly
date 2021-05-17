<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontEndSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frontend_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key');
            $table->string('title');
            $table->string('designation')->comment('this Column is used for OUR Success Story');
            $table->string('description');
            $table->string('icon');
            $table->string('media');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        $data = [
            ['key' => 'where_our_mentor_work_at','title' => '','description' => '','icon'=> 'design/images/logo1.png','media'=> '','designation' =>''],
            ['key' => 'where_our_mentor_work_at','title' => '','description' => '','icon'=> 'design/images/logo2.png','media'=> '','designation' =>''],
            ['key' => 'where_our_mentor_work_at','title' => '','description' => '','icon'=> 'design/images/logo3.png','media'=> '','designation' =>''],
            ['key' => 'where_our_mentor_work_at','title' => '','description' => '','icon'=> 'design/images/logo4.png','media'=> '','designation' =>''],
            ['key' => 'where_our_mentor_work_at','title' => '','description' => '','icon'=> 'design/images/logo5.png','media'=> '','designation' =>''],
            ['key' => 'what_we_do','title' => 'Expert Mentors','description' => "We've brought together the best mentors from finance, healthcare, consulting, and more, both big and small",'icon'=> 'design/images/expert.png','media'=> '','designation' =>''],
            ['key' => 'what_we_do','title' => 'Verified Profiles','description' => "We carefully check and confirm each mentor’s profile",'icon'=> 'design/images/profile.png','media'=> '','designation' =>''],
            ['key' => 'what_we_do','title' => 'Learn Anytime','description' => "Take online lessons at the perfect time for your busy schedule",'icon'=> 'design/images/any-time.png','media'=> '','designation' =>''],
            ['key' => 'what_we_do','title' => 'Affordable Prices','description' => "Choose an experienced mentor that fits your budget.",'icon'=> 'design/images/price.png','media'=> '','designation' =>''],

            ['key' => 'focus_ontheskill_you_need','title' => '','description' => 'Know how to answer those tricky behavioral questions','icon'=> '','media'=> '','designation' =>''],
            ['key' => 'focus_ontheskill_you_need','title' => '','description' => 'Understand the company from the mentor who works or has worked there previously.','icon'=> '','media'=> '','designation' =>''],
            ['key' => 'focus_ontheskill_you_need','title' => '','description' => 'Learn the right questions to ask.','icon'=> '','media'=> '','designation' =>''],
            ['key' => 'focus_ontheskill_you_need','title' => '','description' => 'Understand what to study and how to approach the technical portion of the interview.','icon'=> '','media'=> '','designation' =>''],
            ['key' => 'our_sucess_story','title' => 'Belina','description' => "I was a very shy person in the beginning. After more than 160 hours of classes on Preply, learning languages has somehow made me feel more comfortable about myself.",'icon'=> '','media'=> 'design/images/mentor1.jpg','designation' =>'Mastered 5 languages online on Preply'],
            ['key' => 'our_sucess_story','title' => 'Gowoon S.','description' => "I was a very shy person in the beginning. After more than 160 hours of classes on Preply, learning languages has somehow made me feel more comfortable about myself.",'icon'=> '','media'=> 'design/images/mentor2.jpg','designation' =>'Mastered 5 languages online on Preply'],
            ['key' => 'our_sucess_story','title' => 'Yujing Z.','description' => "I was a very shy person in the beginning. After more than 160 hours of classes on Preply, learning languages has somehow made me feel more comfortable about myself.",'icon'=> '','media'=> 'design/images/mentor3.jpg','designation' =>'Mastered 5 languages online on Preply'],
            ['key' => 'how_mentory_works','title' => '1','description' => 'Find the mentor you like through our search engine.','icon'=> '','media'=> 'design/images/step1.png','designation' =>''],
            ['key' => 'how_mentory_works','title' => '2','description' => 'Create an account and send info.','icon'=> '','media'=> 'design/images/step2.png','designation' =>''],
            ['key' => 'how_mentory_works','title' => '3','description' => 'Set up interview time with mentor.','icon'=> '','media'=> 'design/images/step3.png','designation' =>''],
            ['key' => 'how_mentory_works','title' => '4','description' => 'Start interviewing.','icon'=> '','media'=> 'design/images/step4.png','designation' =>''],
            ['key' => 'become_mentor_home_page','title' => 'Find new Mentees','description' => '','icon'=> '','media'=> 'design/images/new-mentor.png','designation'=>''],
            ['key' => 'become_mentor_home_page','title' => 'Grow your business','description' => '','icon'=> '','media'=> 'design/images/grow-business.png','designation'=>''],
            ['key' => 'become_mentor_home_page','title' => 'Get Paid Securely','description' => '','icon'=> '','media'=> 'design/images/paid-secure.png','designation'=>''],
        ];

        DB::table('frontend_settings')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('front_end_settings');
    }
}
