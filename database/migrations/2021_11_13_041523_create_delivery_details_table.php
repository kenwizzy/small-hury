<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
            ->constrained('orders')->onDelete('cascade');
            $table->string('delivery_contact');
            $table->string('delivery_address');
            $table->string('delivery_phone');
            $table->string('delivery_note');
            $table->string('delivery_reference');
            $table->foreignId('warehouse_id')
                ->nullable()->constrained('warehouses');
            $table->foreignId('status')->constrained('order_status');
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
        Schema::dropIfExists('delivery_details');
    }
}
