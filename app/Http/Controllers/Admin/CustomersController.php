<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApartmentAddress;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\VehicleCuctomer;
use App\Models\SystemCalendar;
use App\Models\Setting;

class CustomersController extends Controller
{

    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $calendar = SystemCalendar::find(1); 
        $customers = Customer::select('id', 'name', 'email', 'phone')->paginate(10);
        $apartmentAddress = ApartmentAddress::select('customer_id', 'block', 'floor', 'apartment')->get();
        return view('admin.customer.listCustomer', compact('customers', 'apartmentAddress', 'calendar'));
    }

    public function create()
    {
        $calendar = SystemCalendar::find(1); 
        $setting_indexs = Setting::find(1);
        return view('admin.customer.createCustomer', compact('calendar', 'setting_indexs'));
    }

    public function store(Request $request)
    {
        $block = $request -> selectBlock;
        $floor = $request -> selectFloor;
        $apartment = $request -> selectApartment;
        if((Customer::checkApartment($block, $floor, $apartment)) === false){
            return redirect() -> back() -> withErrors(['errors'=>'Không thể tạo khách hàng vì địa chỉ đã có người thuê!!!']);
        }
        Customer::createCustomer($request);
            return redirect() -> route('admin.customers.index') -> with(['success'=>'Thêm khách hàng thành công!!!']);
    }

    public function show($id)
    {
        $calendar = SystemCalendar::find(1); 
        $customer = Customer::with('apartmentAddress', 'familyMembers')->find($id);
        return view('admin.customer.detailCustomer', compact('customer', 'calendar'));
    }

    public function edit($id)
    {
        $calendar = SystemCalendar::find(1); 
        $customer = Customer::with('apartmentAddress', 'familyMembers')->find($id);
        $vehicles = VehicleCuctomer::where('customer_id', $id)->get(); // vehicle của khách hàng
        $vehiclesTypes = Vehicle::get(); // các loại vehicle dành cho chức năng thêm vehicle
        return view('admin.customer.editCustomer', compact('customer', 'vehicles', 'vehiclesTypes', 'calendar'));
    }

    public function update(Request $request, $id)
    {
        $calendar = SystemCalendar::find(1); 
        $month = $calendar -> month;
        $year = $calendar -> year;

        $customer = Customer::find($id);
        $customer -> name = $request -> name;
        $customer -> email = $request -> email;
        $customer -> phone = $request -> phone;
        $customer -> date_of_birth = $request -> date_of_birth;
        $customer -> gender = $request -> gender;
        $customer -> save();

        // nếu có chỉnh sửa phần phương tiện về số lượng và tình trạng
        $car_amount = $request -> car_amount;
        $moto_amount = $request -> moto_amount;
        $bike_amount = $request -> bike_amount;

        $status_car = $request -> status_car;
        $status_moto = $request -> status_moto;
        $status_bike = $request -> status_bike;

        $new_vehicle_type = $request->add_new_vehicle_type;
        $new_vehicle_amount = $request->add_new_vehicle_amount;
        
        $vehicles = VehicleCuctomer::where('customer_id', $id)->get();
        foreach($vehicles as $vehicle){
            if($vehicle->vehicle_id == 1){
                $vehicle->amount = $car_amount;
                if(($car_amount > 0) || ($status_car && $status_car == 2))
                {
                    $vehicle->using = 1;
                }
                if(($car_amount == 0) || ($status_car && $status_car == 1))
                {
                    $vehicle->using = 0;
                }
                $vehicle -> save();
            }
            if($vehicle->vehicle_id == 2){
                $vehicle->amount = $moto_amount;
                if(($moto_amount > 0)|| $status_moto && $status_moto == 2)
                {
                    $vehicle->using = 1;
                }
                if(($moto_amount == 0) || ($status_moto && $status_moto == 1))
                {
                    $vehicle->using = 0;
                }
                $vehicle -> save();
            }
            if($vehicle->vehicle_id == 3){
                $vehicle->amount = $bike_amount;
                if(($bike_amount > 0) || ($status_bike && $status_bike == 2)) 
                {
                    $vehicle->using = 1;
                }
                if(($bike_amount == 0) || ($status_bike && $status_bike == 1))
                {
                    $vehicle->using = 0;
                }
                $vehicle -> save();
            }
        }
        // nếu có thêm phương tiện cùng số lượng
        
        $typeVehicle_Car = Vehicle::where('id', 1)->first();
        $typeVehicle_Moto = Vehicle::where('id', 2)->first();
        $typeVehicle_Bike = Vehicle::where('id', 3)->first();

        if($new_vehicle_type != 0)
        {
            $this->validate($request, [
                'add_new_vehicle_amount' => 'required'
            ]);
            // nếu khách hàng chưa có phương tiện nào
            if($vehicles -> count() == 0){  
                // if customer have car
                if($new_vehicle_type == 1){
                    $customer->vehicles()->attach($typeVehicle_Car, [ 'amount' => $new_vehicle_amount,
                                                    'month_start_use' => $month, 'year_use' => $year, 'using' => 1
                                                    ]);                          
                }
                // if customer have moto
                if($new_vehicle_type == 2){
                    $customer->vehicles()->attach($typeVehicle_Moto, [ 'amount' => $new_vehicle_amount,
                                                        'month_start_use' => $month, 'year_use' => $year, 'using' => 1
                                                        ]);
                }
                // if customer have bike
                if($new_vehicle_type == 3){
                    $customer->vehicles()->attach($typeVehicle_Bike, [ 'amount' => $new_vehicle_amount,
                                                        'month_start_use' => $month, 'year_use' => $year, 'using' => 1
                                                        ]);
                }
            }
            // nếu khách hàng đã có những phương tiện
            if($vehicles -> count() > 0){
                // nếu khách hàng chọn một phương tiện mới
                foreach($vehicles as $vehicle){
                        // if customer have car
                    if($new_vehicle_type == 1){
                        $customer->vehicles()->attach($typeVehicle_Car, [ 'amount' => $new_vehicle_amount,
                                                        'month_start_use' => $month, 'year_use' => $year, 'using' => 1
                                                        ]);                          
                    }
                    // if customer have moto
                    if($new_vehicle_type == 2){
                        $customer->vehicles()->attach($typeVehicle_Moto, [ 'amount' => $new_vehicle_amount,
                                                            'month_start_use' => $month, 'year_use' => $year, 'using' => 1
                                                            ]);
                    }
                    // if customer have bike
                    if($new_vehicle_type == 3){
                        $customer->vehicles()->attach($typeVehicle_Bike, [ 'amount' => $new_vehicle_amount,
                                                            'month_start_use' => $month, 'year_use' => $year, 'using' => 1
                                                            ]);
                    }
                break;
                }
            }
        }
        return redirect() -> back() -> with(['success'=>'Cập nhật thông tin chủ hộ thành công!!!']);
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return redirect()->back()->with('success', 'Xóa khách hàng thành công!');
    }
}
