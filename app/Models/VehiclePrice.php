<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehiclePrice extends Model
{
    //
}
protected $table = 'vehicle_customer';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'vehicle_type_id', 'living_expenses_type_id', 'month_use', 'amount'
    ];
    
    public function user() {
        return $this->belongsTo('App\User');
    }
}
Schema::create('vehicle_customer', function (Blueprint $table) {
    $table->id();
    $table->integer('living_expenses_type_id');
    $table->integer('month_use')->nullable();
    $table->integer('amount')->default(0); // số lượng

    $table->unsignedBigInteger('customer_id');
    $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

    $table->unsignedBigInteger('vehicle_type_id');
    $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types')->onDelete('cascade');
    
    $table->timestamps();
    $table->softDeletes();