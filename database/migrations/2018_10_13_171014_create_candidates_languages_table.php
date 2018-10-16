<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('candidates_id');
            $table->unsignedInteger('languages_id');
            $table->tinyInteger('level')->default(0)->comment('0: yếu, 1: trung bình, 2:khá, 3:giỏi');
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
        Schema::dropIfExists('candidates_languages');
    }
}
