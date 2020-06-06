<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class VehicleCuctomer extends Model
{
    protected $table = 'customer_vehicle';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'month_start_use', 'year_use', 'amount', 'using', 'customer_id', 'vehicle_id'
    ];
    
    // public function user() {
    //     return $this->belongsTo(Customer::class);
    // }
}
