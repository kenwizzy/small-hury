<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('internal_ref')->nullable();
            $table->string('name');
            $table->text('description');
            //$table->foreignId('category_id')->constrained('categories')->onUpdate('cascade');
            $table->foreignId('sub_category_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->string('slug');
            $table->decimal('real_price', 15, 2);
            $table->decimal('original_price', 15, 2)->nullable();
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->timestamp('sales_expiry')->nullable();
            $table->tinyInteger('on_sales')->default(0);
            $table->foreignId('added_by');
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
