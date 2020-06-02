<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_prices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price_regulation_id')->nullable();
            $table->integer('vehicle_type_id');
            $table->decimal('price',15, 2); // giá tiền cao nhất

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_prices');
    }
}
