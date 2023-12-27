<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeenContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seen_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enroll_id');
            $table->unsignedBigInteger('subscription_enroll_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('content_id');
            //this user id for student
            $table->unsignedBigInteger('user_id');

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
        Schema::dropIfExists('seen_contents');
    }
}
