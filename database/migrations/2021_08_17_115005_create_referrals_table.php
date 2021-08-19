<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',20)->unique();
            $table->bigInteger('userId');
            $table->string('userType');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        $data = [];
        $mentee = \App\Models\User::get();
        foreach ($mentee as $key => $user) {
            $referral = generateUniqueReferral();
            DB::table('referrals')->where('id',$referral->id)->update(['userId'=>$user->id,'userType' => 'web']);
        }
        $mentor = \App\Models\Mentor::get();
        foreach ($mentor as $key => $user) {
            $referral = generateUniqueReferral();
            DB::table('referrals')->where('id',$referral->id)->update(['userId'=>$user->id,'userType' => 'mentor']);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referrals');
    }
}
