<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropWarehouseAndOrderStatusColumnFromDeliveryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_details', function (Blueprint $table) {
            $table->dropForeign(['status']);
            $table->dropForeign(['warehouse_id']);
            $table->dropColumn(['status','warehouse_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delivery_details', function (Blueprint $table) {
            $table->foreignId('warehouse_id')
                ->nullable()->constrained('warehouses');
            $table->foreignId('status')->constrained('order_status');
        });
    }
}
