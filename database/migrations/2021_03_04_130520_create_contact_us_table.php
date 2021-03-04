<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('type')->default(1)->comment('1:contacted, 0 :address to show on web');
            $table->string('title');
            $table->longText('address');
            $table->string('mobile');
            $table->string('email');
            $table->string('linkedinLink');
            $table->string('facebookLink');
            $table->string('instagramLink');
            $table->string('twitterLink');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        $data = [
            [
                'type' => 0,
                'title' => 'Headquater',
                'address' => '35 Nowland St, Seven Hills, NSW 2147',
                'mobile' => '0433 019 012',
                'email' => 'info@gmail.com',
                'linkedinLink' => 'https://in.linkedin.com/',
                'facebookLink' => 'https://www.facebook.com/',
                'instagramLink' => 'https://www.instagram.com/',
                'twitterLink' => 'https://twitter.com/',
            ],
        ];
        DB::table('contact_us')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_us');
    }
}
