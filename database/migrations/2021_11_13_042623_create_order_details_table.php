<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
            ->constrained('orders')->onDelete('cascade');
            $table->foreignId('product_id')
            ->constrained('products');
            $table->string('product_name');
            $table->integer('quantity');
            $table->foreignId('delivery_detail_id')
            ->constrained('delivery_details')->onUpdate('cascade');
            $table->tinyInteger('on_sales')->unsigned();
            $table->tinyInteger('status')->unsigned()->default(1);
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
        Schema::dropIfExists('order_details');
    }
}
