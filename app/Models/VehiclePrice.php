<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehiclePrice extends Model
{
    //
    protected $table = 'vehicle_prices';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price_regulation_id','vehicle_type_id', 'price'
    ];
    
    // public function user() {
    //     return $this->belongsTo('App\User');
    // }
}