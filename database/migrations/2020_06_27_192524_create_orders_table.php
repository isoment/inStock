<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('status')->nullable();
            $table->string('tracking')->nullable();
            $table->string('shipper')->nullable();
            $table->string('ship_to');
            $table->string('ship_address');
            $table->decimal('tax', 8, 2)->nullable();
            $table->decimal('shipping', 8, 2)->nullable();
            $table->decimal('order_subtotal', 8, 2)->nullable();
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
        Schema::dropIfExists('orders');
    }
}
