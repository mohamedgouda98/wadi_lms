<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagePurchaseHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_purchase_histories', function (Blueprint $table) {
            $table->id();
            $table->double('amount')->nullable();
            $table->string('payment_method')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('package_id');
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
        Schema::dropIfExists('package_purchase_histories');
    }
}
