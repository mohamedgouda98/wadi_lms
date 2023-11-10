<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePointTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('point_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('message')->nullable();
            $table->morphs('pointable');
            $table->bigInteger('amount')->nullable();
            $table->unsignedBigInteger('current')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('point_transactions');
    }
}
