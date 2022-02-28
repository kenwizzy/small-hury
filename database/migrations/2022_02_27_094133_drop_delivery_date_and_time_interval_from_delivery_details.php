<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropDeliveryDateAndTimeIntervalFromDeliveryDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_details', function (Blueprint $table) {
            $table->dropColumn(['delivery_date','time_interval']);
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
            $table->date('delivery_date');
            $table->string('time_interval');
        });
    }
}
