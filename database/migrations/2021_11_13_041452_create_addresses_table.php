<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')->onDelete('cascade');
            $table->string('street')->nullable();
            $table->string('name');
            $table->double('longitude', 11, 5)->nullable();
            $table->double('latitude', 11, 5)->nullable();
            $table->string("pincode")->nullable();
            $table->string("country")->default("Nigeria");
            $table->string("state")->nullable()->default("Abuja");
            $table->string("city");
            $table->string("landmark")->nullable();
            $table->unsignedTinyInteger("default")->default(0);
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
        Schema::dropIfExists('addresses');
    }
}
