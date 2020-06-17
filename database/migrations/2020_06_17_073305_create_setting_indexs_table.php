<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingIndexsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_indexs', function (Blueprint $table) {
            $table->id();
            $table->integer('highest_number_of_cars')->default(0);
            $table->integer('highest_number_of_motos')->default(0);
            $table->integer('highest_number_of_bikes')->default(0);
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
        Schema::dropIfExists('setting_indexs');
    }
}
