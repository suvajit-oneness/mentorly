<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('jobTypeId');
            $table->string('name');
            $table->string('location');
            $table->longText('description');
            $table->date('valid_till');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        $type = DB::table('job_types')->get();$data = [];
        foreach ($type as $key => $value) {
            $data[] = [
                'jobTypeId' => $value->id,
                'name' => 'Application Developer',
                'location' => 'kolkata,mumbai,pune',
                'valid_till' => date('Y-m-d',strtotime('+30 days')),
                'description' => "<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi voluptate quam non esse? Natus vitae deserunt doloribus aliquam eveniet corporis, ducimus eum dignissimos minus rerum. Distinctio vero sapiente fugit accusantium.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum pariatur quasi, excepturi nobis, dolor placeat, est quibusdam blanditiis minima maxime dolorem maiores quidem dignissimos aliquam natus inventore fugiat doloremque suscipit?</p><p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi voluptate quam non esse? Natus vitae deserunt doloribus aliquam eveniet corporis, ducimus eum dignissimos minus rerum. Distinctio vero sapiente fugit accusantium.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum pariatur quasi, excepturi nobis, dolor placeat, est quibusdam blanditiis minima maxime dolorem maiores quidem dignissimos aliquam natus inventore fugiat doloremque suscipit?</p><p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi voluptate quam non esse? Natus vitae deserunt doloribus aliquam eveniet corporis, ducimus eum dignissimos minus rerum. Distinctio vero sapiente fugit accusantium. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum pariatur quasi, excepturi nobis, dolor placeat, est quibusdam blanditiis minima maxime dolorem maiores quidem dignissimos aliquam natus inventore fugiat doloremque suscipit?</p>",
            ];
            $data[] = [
                'jobTypeId' => $value->id,
                'name' => 'Application Designer',
                'location' => 'kolkata,mumbai,pune',
                'valid_till' => date('Y-m-d',strtotime('+30 days')),
                'description' => "<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi voluptate quam non esse? Natus vitae deserunt doloribus aliquam eveniet corporis, ducimus eum dignissimos minus rerum. Distinctio vero sapiente fugit accusantium.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum pariatur quasi, excepturi nobis, dolor placeat, est quibusdam blanditiis minima maxime dolorem maiores quidem dignissimos aliquam natus inventore fugiat doloremque suscipit?</p><p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi voluptate quam non esse? Natus vitae deserunt doloribus aliquam eveniet corporis, ducimus eum dignissimos minus rerum. Distinctio vero sapiente fugit accusantium.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum pariatur quasi, excepturi nobis, dolor placeat, est quibusdam blanditiis minima maxime dolorem maiores quidem dignissimos aliquam natus inventore fugiat doloremque suscipit?</p><p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi voluptate quam non esse? Natus vitae deserunt doloribus aliquam eveniet corporis, ducimus eum dignissimos minus rerum. Distinctio vero sapiente fugit accusantium. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum pariatur quasi, excepturi nobis, dolor placeat, est quibusdam blanditiis minima maxime dolorem maiores quidem dignissimos aliquam natus inventore fugiat doloremque suscipit?</p>",
            ];
        }
        DB::table('jobs')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
