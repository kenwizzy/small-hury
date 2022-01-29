<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropFourColumnsFromCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['warehouse_id']);
            $table->dropColumn(['product_id','warehouse_id','product_name','quantity']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->foreignId('product_id')
                    ->constrained('products');
            $table->string('product_name')->nullable();
            $table->integer('quantity')->default(1);
            $table->foreignId('warehouse_id')->constrained('warehouses');
        });
    }
}
