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
        'customer_id', 'vehicle_id', 'amount', 'month_start_use', 'year_use', 'using'
    ];
    
    // public function user() {
    //     return $this->belongsTo(Customer::class);
    // }
}
