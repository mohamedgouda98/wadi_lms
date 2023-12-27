longText<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->longText('title')->nullable();
            $table->longText('slug')->nullable();
            $table->enum('level', ['Beginner', 'Advanced', 'All Levels']);
            $table->enum('rating', ['1', '2', '3', '4', '5'])->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('big_description')->nullable();
            $table->longText('image')->nullable();
            $table->longText('overview_url')->nullable(); //there are course overview video
            $table->enum('provider', ['Youtube', 'HTML5', 'Vimeo'])->nullable();
            $table->json('requirement')->nullable(); //save all course requirement json
            $table->json('outcome')->nullable();
            $table->json('tag')->nullable();

            //this is for free
            $table->boolean('is_free')->nullable();
            //if course is not free
            $table->double('price')->nullable();
            // $table->double('price')->nullable();
            //this is for discount
            $table->boolean('is_discount')->nullable();
            //this is after discount price / calculate the discount from controller
            $table->double('discount_price')->nullable();
            //this is for video language dropdown from language
            $table->string('language')->nullable();
            //meta data
            $table->text('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->boolean('is_published')->nullable();
            $table->boolean('top')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('courses');
    }
}
