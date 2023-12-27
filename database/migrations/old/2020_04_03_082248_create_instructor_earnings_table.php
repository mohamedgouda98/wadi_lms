<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_earnings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('enrollment_id')->unsigned();
            //package
            $table->bigInteger('package_id')->unsigned();

            $table->double('course_price')->nullable();
            $table->double('will_get')->nullable();
            //instructor
            $table->bigInteger('user_id')->unsigned();
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
        Schema::dropIfExists('instructor_earnings');
    }
}
