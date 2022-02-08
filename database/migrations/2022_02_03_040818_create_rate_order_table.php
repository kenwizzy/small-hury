<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained('users')->onDelete('cascade');
            $table->foreignId('order_id')
            ->constrained('orders')->onDelete('cascade');
            $table->text('comment')->nullable();
            $table->tinyInteger('overall_rating',false,true)->nullable();
            $table->tinyInteger('delivery_rating',false,true)->nullable();
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
        Schema::dropIfExists('rate_orders');
    }
}
