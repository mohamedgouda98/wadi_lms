<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_contents', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->enum('content_type', ['Video', 'Document', 'Live'])->nullable();
            //if video
            $table->enum('provider', ['Youtube', 'HTML5', 'Vimeo', 'File', 'Live'])->nullable();
            $table->longText('video_url')->nullable();
            $table->unsignedBigInteger('meeting_id')->nullable(); //meeting_id
            $table->integer('duration')->nullable();
            //if document
            $table->string('file')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('class_id');
            $table->integer('priority')->nullable();
            $table->boolean('is_published')->nullable();
            $table->boolean('is_preview')->nullable();
            $table->longText('source_code')->nullable();
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
        Schema::dropIfExists('class_contents');
    }
}
