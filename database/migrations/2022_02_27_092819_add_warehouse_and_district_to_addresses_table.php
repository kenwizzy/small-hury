<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWarehouseAndDistrictToAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {

            $table->integer('district_id')->constrained('warehouse_districts');
            $table->integer('warehouse_id')->constrained('warehouses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign(['district_id']);
            $table->dropForeign(['warehouse_id']);
            $table->dropColumn(['district_id','warehouse_id']);
        });
    }
}
