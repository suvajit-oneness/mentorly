<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_requirements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('jobId');
            $table->string('name');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        $job = DB::table('jobs')->get();$data = [];
        foreach ($job as $key => $value) {
            $data[] = [
                'jobId' => $value->id,
                'name' => 'Btech, BCA and MCA'
            ];
            $data[] = [
                'jobId' => $value->id,
                'name' => '2 Year Work Experience',
            ];
        }
        DB::table('job_requirements')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_requirements');
    }
}
