<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LicensePlates extends Model
{
    public $table = 'license_plates';

    protected $fillable = [
        'customer_id',
        'vehicle_type_id',
        'license_plates',
        
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function carLicensePlates(Request $request, $customer_id){
        // cars
        if($request->license_plates_car_1)
        {
            $carLicensePlate = new LicensePlates();
            $carLicensePlate->license_plates = $request->license_plates_car_1;
            $carLicensePlate->customer_id = $customer_id;
            $carLicensePlate->vehicle_type_id = 1;
            $carLicensePlate->save();
        }
        if($request->license_plates_car_2)
        {
            $carLicensePlate = new LicensePlates();
            $carLicensePlate->license_plates = $request->license_plates_car_2;
            $carLicensePlate->customer_id = $customer_id;
            $carLicensePlate->vehicle_type_id = 1;
            $carLicensePlate->save();
        }
        if($request->license_plates_car_3)
        {
            $carLicensePlate = new LicensePlates();
            $carLicensePlate->license_plates = $request->license_plates_car_3;
            $carLicensePlate->customer_id = $customer_id;
            $carLicensePlate->vehicle_type_id = 1;
            $carLicensePlate->save();
        }
    }

    public static function motoLicensePlates(Request $request, $customer_id){
        // cars
        if($request->license_plates_moto_1)
        {
            $motoLicensePlate = new LicensePlates();
            $motoLicensePlate->license_plates = $request->license_plates_moto_1;
            $motoLicensePlate->customer_id = $customer_id;
            $motoLicensePlate->vehicle_type_id = 2;
            $motoLicensePlate->save();
        }
        if($request->license_plates_moto_2)
        {
            $motoLicensePlate = new LicensePlates();
            $motoLicensePlate->license_plates = $request->license_plates_moto_2;
            $motoLicensePlate->customer_id = $customer_id;
            $motoLicensePlate->vehicle_type_id = 2;
            $motoLicensePlate->save();
        }
        if($request->license_plates_moto_3)
        {
            $motoLicensePlate = new LicensePlates();
            $motoLicensePlate->license_plates = $request->license_plates_moto_3;
            $motoLicensePlate->customer_id = $customer_id;
            $motoLicensePlate->vehicle_type_id = 2;
            $motoLicensePlate->save();
        }
        if($request->license_plates_moto_4)
        {
            $motoLicensePlate = new LicensePlates();
            $motoLicensePlate->license_plates = $request->license_plates_moto_4;
            $motoLicensePlate->customer_id = $customer_id;
            $motoLicensePlate->vehicle_type_id = 2;
            $motoLicensePlate->save();
        }
        if($request->license_plates_moto_5)
        {
            $motoLicensePlate = new LicensePlates();
            $motoLicensePlate->license_plates = $request->license_plates_moto_5;
            $motoLicensePlate->customer_id = $customer_id;
            $motoLicensePlate->vehicle_type_id = 2;
            $motoLicensePlate->save();
        }
        
    }
}
