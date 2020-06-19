<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SystemCalendar;
use App\Models\Customer;
use App\Models\VehicleCuctomer;

class CustomerHomeController extends Controller
{
    public function index()
    {
        return view('customer.home');
    }

    public function showInfo($id){
        $calendar = SystemCalendar::find(1); 
        $customer = Customer::with('apartmentAddress', 'familyMembers')->find($id);
        $vehicles = VehicleCuctomer::where('customer_id', $id)->get(); // vehicle của khách hàng
        return view('customer.profile.profile', compact('customer', 'vehicles', 'calendar'));

    }
}
