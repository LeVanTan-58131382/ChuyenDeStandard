<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceRegulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_regulations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('living_expenses_type_id'); // mã loại phí
            $table->integer('month_start_of_use'); // tháng bắt đầu áp dụng

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
        Schema::dropIfExists('price_regulations');
    }
}
