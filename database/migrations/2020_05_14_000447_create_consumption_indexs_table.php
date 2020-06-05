<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumptionIndexsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumption_indexs', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id'); // mã khách hàng
            $table->integer('living_expenses_type_id'); // mã loại phí
            $table->integer('month_consumption'); // tháng tiêu thụ
            $table->integer('year_consumption'); // năm tiêu thụ
            $table->double('last_month_index'); // chỉ số tháng trước
            $table->double('this_month_index'); // chỉ số tháng này
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
        Schema::dropIfExists('consumption_indices');
    }
}
