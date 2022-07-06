<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableStar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('star_rating', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->integer('star');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('order_id');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('product')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('users')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('order')->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('star_rating');
    }
}
