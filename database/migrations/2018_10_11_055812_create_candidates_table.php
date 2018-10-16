<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->text('image');
            $table->string('name');
            $table->string('title');
            $table->string('slug');
            $table->tinyInteger('gender')->default(0)->comment('0: nu, 1: nam, 2: bd');
            $table->string('address');
            $table->string('email');
            $table->string('phone');
            $table->string('birthday');
            $table->tinyInteger('marital')->default(0)->comment('0: doc than, 1: da ket hon');
            $table->tinyInteger('time_id');
            $table->tinyInteger('rating')->default(0);
            $table->string('experience');
            $table->tinyInteger('educations_id')->default(0);
            $table->tinyInteger('wages_id');
            $table->text('skill');
            $table->text('work_experience');
            $table->text('content');
            $table->text('about_me');
            $table->text('specialize');
            $table->text('prize');
            $table->text('reference');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('created_by');
            $table->string('updated_by');
            $table->tinyInteger('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidates');
    }
}
