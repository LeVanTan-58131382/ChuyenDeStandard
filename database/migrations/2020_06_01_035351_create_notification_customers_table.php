<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_notification', function (Blueprint $table) {
        $table->id();

        $table->boolean('read')->default(0);
        $table->boolean('deleted')->default(0);
        $table->integer('bill_id')->nullable();

        // thiết lập quan hệ giữa 2 bảng notifications và customers
        $table->unsignedBigInteger('customer_id');
        $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

        $table->unsignedBigInteger('notification_id');
        $table->foreign('notification_id')->references('id')->on('notifications')->onDelete('cascade');

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
        Schema::dropIfExists('notification_customers');
    }
}
