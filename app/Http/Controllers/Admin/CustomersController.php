<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApartmentAddress;
use App\Models\Customer;
use App\Models\VehicleCuctomer;

class CustomersController extends Controller
{
    // public function customers()
    // {
    //     $listUsers = User::select('*')->where('id', '>', 1)->paginate(10);
    //     $apartments = ApartmentAddress::get();
    //     return view('admin.customer.listCustomer')->with('listUsers', $listUsers)->with('apartments', $apartments);
    // }
    
    // public function create_customer()
    // {
    //     return view('admin.customer.createCustomer');
    // }

    // public function store_customer(Request $request, UserRequest $uRequest)
    // {
    //     // Nếu người dùng chọn địa chỉ đã tồn tại và có người thuê thì báo lỗi -> rơi vào trường hợp 2
    //     if(ApartmentAddress::addForUserAndCreateUser($request, $uRequest) == 1){
    //         return redirect() -> route('create-cus') -> withErrors(['errors'=>'Không thể tạo khách hàng vì địa chỉ đã có người thuê!!!']);
    //     }
    //     ApartmentAddress::addForUserAndCreateUser($request, $uRequest); // rơi vào trường hợp 1
    //     return redirect() -> route('list-cus') -> with(['success'=>'Thêm khách hàng thành công!!!']);
    // }

    // public function show_customer($id)
    // {
    //     $user = User::findOrFail($id);
    //     $apartment = User::find($id)->apartment;
    //     return view('admin.customer.detailCustomer')->with('user', $user)->with('apartment', $apartment);
    // }

    // public function edit_customer($id)
    // {
    //     $user = User::findOrFail($id);
    //     $apartment = User::find($id)->apartment;
    //     return view('admin.customer.editCustomer')->with('user', $user)->with('apartment', $apartment);
    // }

    // public function update_customer(Request $request, $id)
    // {
    //     //
    // }

    // public function destroy_customer($id)
    // {
    //     $user = User::findOrFail($id);
    //     $user -> delete();
    //     return redirect() -> route('list-cus') -> with(['success'=>'Xóa khách hàng thành công!!!']);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::select('id', 'name', 'email', 'phone')->paginate(10);
        $apartmentAddress = ApartmentAddress::select('customer_id', 'block', 'floor', 'apartment')->get();
        return view('admin.customer.listCustomer', compact('customers', 'apartmentAddress'));
    }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer.createCustomer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::with('apartmentAddress', 'familyMembers')->find($id);
        return view('admin.customer.detailCustomer', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::with('apartmentAddress', 'familyMembers')->find($id);
        $vehicles = VehicleCuctomer::where('customer_id', $id)->get();
        return view('admin.customer.editCustomer', compact('customer', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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
        //dd($status_car);
        $vehicles = VehicleCuctomer::where('customer_id', $id)->get();
        foreach($vehicles as $vehicle){
            if($vehicle->vehicle_id == 1){
                $vehicle->amount = $car_amount;
                if($status_car && $status_car == 1)
                {
                    $vehicle->using = 0;
                }
                if($status_car && $status_car == 2)
                {
                    $vehicle->using = 1;
                }
                $vehicle -> save();
            }
            if($vehicle->vehicle_id == 2){
                $vehicle->amount = $moto_amount;
                if($status_moto && $status_moto == 1)
                {
                    $vehicle->using = 0;
                }
                if($status_moto && $status_moto == 2)
                {
                    $vehicle->using = 1;
                }
                $vehicle -> save();
            }
            if($vehicle->vehicle_id == 3){
                $vehicle->amount = $bike_amount;
                if($status_bike && $status_bike == 1)
                {
                    $vehicle->using = 0;
                }
                if($status_bike && $status_bike == 2)
                {
                    $vehicle->using = 1;
                }
                $vehicle -> save();
            }
        }
        return redirect() -> back() -> with(['success'=>'Cập nhật thông tin chủ hộ thành công!!!']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return redirect()->back()->with('success', 'Xóa khách hàng thành công!');
    }
}
