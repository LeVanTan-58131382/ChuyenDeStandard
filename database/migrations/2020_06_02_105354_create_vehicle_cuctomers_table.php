<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleCuctomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_vehicle', function (Blueprint $table) {
            $table->id();
            $table->integer('month_start_use');
            $table->integer('year_use');
            $table->integer('amount')->default(0); // số lượng

            $table->integer('using')->default(1); // đánh dấu khách hàng có đang sử dụng phương tiện
                                                  // hay không, phục vụ cho trường hợp khách hàng không
                                                  // sử dụng phương tiện đó nữa
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        
            $table->unsignedBigInteger('vehicle_id'); // mã phương tiện của customer
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            
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
        Schema::dropIfExists('vehicle_cuctomers');
    }
}
