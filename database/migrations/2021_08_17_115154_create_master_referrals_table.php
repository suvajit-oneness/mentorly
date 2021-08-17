<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_referral', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('off_percentage',8,2);
            $table->string('offer_detail');
            $table->float('reward_amount',8,2);
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        $data = [
            'off_percentage' => 70,
            'offer_detail' => 'their first lesson',
            'reward_amount' => 30
        ];
        DB::table('master_referral')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_referral');
    }
}
