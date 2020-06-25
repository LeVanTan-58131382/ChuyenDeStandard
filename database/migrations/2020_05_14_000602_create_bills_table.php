<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('customer_id'); 
            $table->integer('living_expenses_type_id'); 
            $table->integer('price_regulation_id'); 
            $table->integer('payment_month');
            $table->integer('payment_year');
            $table->integer('money_to_pay');
            //$table->decimal('money_to_pay',15, 2); 
            $table->integer('usage_level_max')->nullable(); // mức sử dụng cao nhất đối với điện và nước
            $table->boolean('paid')->default(0);

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
        Schema::dropIfExists('bills');
    }
}
