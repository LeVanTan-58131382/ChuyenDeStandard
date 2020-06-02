<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleCuctomer extends Model
{
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
