<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Vehicle extends Model
{
    protected $table = 'vehicles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function customers() {
        return $this->belongsToMany(Customer::class)->using(VehicleCuctomer::class);
    }
}
