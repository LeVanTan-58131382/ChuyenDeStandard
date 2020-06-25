<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsageNormInvestorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usage_norm_investors', function (Blueprint $table) {
            $table->id();
            $table->integer('price_regulation_id')->nullable();
            $table->string('name');
            $table->integer('level');
            $table->integer('living_expenses_type_id'); // mã loại phí
            $table->double('usage_index_from'); // chỉ số sử dụng từ
            $table->double('usage_index_to'); // chỉ số sử dụng đến
            $table->integer('price');
            //$table->decimal('price',15, 2); // giá tiền

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
        Schema::dropIfExists('usage_norm_investors');
    }
}
