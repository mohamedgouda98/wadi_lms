<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_rewards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned(); // user id
            $table->bigInteger('game_id')->unsigned(); // game id
            $table->bigInteger('total_points')->unsigned(); // 5
            $table->longText('reward')->nullable(); // 10 points
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
        Schema::dropIfExists('game_rewards');
    }
}
