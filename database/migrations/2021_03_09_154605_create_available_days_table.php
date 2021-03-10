<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailableDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('available_days', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('day');
            $table->string('short_day');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        
        $data = [
            ['day'=>'Monday','short_day'=>'Mon'],
            ['day'=>'Tuesday','short_day'=>'Tue'],
            ['day'=>'Wednesday','short_day'=>'Wed'],
            ['day'=>'Thrusday','short_day'=>'Thu'],
            ['day'=>'Friday','short_day'=>'Fri'],
            ['day'=>'Saturday','short_day'=>'Sat'],
            ['day'=>'Sunday','short_day'=>'Sun'],
        ];
        DB::table('available_days')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('available_days');
    }
}
