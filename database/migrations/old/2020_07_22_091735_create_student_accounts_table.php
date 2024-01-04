<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //this is student
            $table->longText('bank')->nullable();
            $table->longText('bank_name')->nullable();
            $table->longText('account_name')->nullable();
            $table->longText('account_number')->nullable();
            $table->integer('routing_number')->nullable();

            $table->longText('paypal')->nullable();
            $table->longText('paypal_acc_name')->nullable();
            $table->longText('paypal_acc_email')->nullable();

            $table->longText('stripe')->nullable();
            $table->longText('stripe_acc_name')->nullable();
            $table->longText('stripe_acc_email')->nullable();
            $table->longText('stripe_card_holder_name')->nullable();
            $table->longText('stripe_card_number')->nullable();
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
        Schema::dropIfExists('student_accounts');
    }
}
