<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaypalInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paypal_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('album_id')->index();
            $table->uuid('user_id')->index();
            $table->string('payer_id');
            $table->string('payment_id');
            $table->string('payment_token');
            $table->timestamps();

            $table->foreign('album_id')->references('id')->on('albums')->onDelete('no action');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paypal_invoices');
    }
}
