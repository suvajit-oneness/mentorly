<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('userType');
            $table->bigInteger('userId');
            $table->float('points',8,2)->default(0);
            $table->float('amount',8,2)->default(0);
            $table->float('percentage',8,2)->default(0);
            $table->string('remarks')->comment('point/amount/percentage credited for');
            $table->integer('valid_till')->comment('valid range in months')->default(12);
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
        Schema::dropIfExists('user_points');
    }
}
