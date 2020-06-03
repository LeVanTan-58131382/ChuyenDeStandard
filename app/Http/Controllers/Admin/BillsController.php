<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\ApartmentAddress;
use App\Models\Customer;
use App\Models\PriceRegulation;
use App\Models\SystemCalendar;

class BillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::get();
        $customers = Customer::paginate(10);
        $apartments = ApartmentAddress::get();
        return view('admin.paymentForServices.index', compact('bills', 'customers', 'apartments'));
    }

    public function create()
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createBill($customerId)
    {
        $celendar = SystemCalendar::find(1);
        $month = $celendar -> month;

        // nếu khách hàng đạ dc xuất hóa đơn cho tháng 5 thì không xuất nữa
        $bills = Bill::select('*')->where('customer_id', $customerId)->where('payment_month', $month)->get();
        if(!$bills->isEmpty()){
            return view('admin.paymentForServices.billexported');
        }

        $price_regulation_elects = PriceRegulation::select('*')->where('living_expenses_type_id', 1)->get();
        $price_regulation_waters = PriceRegulation::select('*')->where('living_expenses_type_id', 2)->get();
        $price_regulation_cars = PriceRegulation::select('*')->where('living_expenses_type_id', 3)->get();
        $customer_id = $customerId;
        $customer = Customer::find($customerId);
        $vehicle = $customer->vehicles()->whereIn('customer_id', $customer_id);
        dd($vehicle);

        foreach($customer->vehicles as $vehicle){
            echo($vehicle->pivot_customer_id);
        }
        die();
        
        return view('admin.paymentForServices.detailPayment', compact('price_regulation_elects', 'price_regulation_waters', 'price_regulation_cars', 'vehicles', 'customer_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
