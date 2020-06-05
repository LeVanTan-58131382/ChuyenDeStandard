<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Customer;

class StatisticalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::get();
        $result = 0;
        $result_processed = 0;
        return view('admin.paymentForServices.statistical', compact('customers', 'result', 'result_processed'));
    }

    public function statistical(Request $request)
    {
        $type = $request -> type;
        $customer_Id = $request -> customer;
        $month = $request -> month;
        $year = $request -> year;
        $monthFrom = $request -> monthFrom;
        $yearFrom = $request -> yearFrom;
        $monthTo = $request -> monthTo;
        $yearTo = $request -> yearTo;

        // thống kê một loại phí dịch vụ theo một tháng đã chọn của tất cả khách hàng
        if($type != 0 && $customer_Id == 0 && $month != 0 && $year != 0 && $monthFrom == 0 && $yearFrom == 0 && $monthTo == 0 && $yearTo == 0)
        {
            return $this::statisticalByMonth($type, $month, $year);
        }

        // thống kê phí dịch vụ của một khách hàng theo một tháng đã chọn
        elseif($type != 0 && $customer_Id != 0 && $month != 0 && $monthFrom == 0 && $yearFrom == 0 && $monthTo == 0 && $yearTo == 0)
        {
            return $this::statisticalByCustomerByMonth($type, $customer_Id, $month, $year);
        }

        // thống kê phí dịch vụ của một khách hàng theo một khoảng thời gian từ tháng A đến tháng B
        elseif($type != 0 && $customer_Id != 0 && $month == 0 && $monthFrom != 0 && $yearFrom != 0 && $monthTo != 0 && $yearTo != 0)
        {
            return $this::statisticalByCustomerByMonthToMonth($type, $customer_Id, $monthFrom, $yearFrom, $monthTo, $yearTo);
        }

        else {
            return redirect()->back()->withErrors(['errors'=>'Một hoặc nhiều option bạn chọn chưa chính xác!!!']);
        }

    }

    // thống kê phí dịch vụ của tất cả khách hàng theo một tháng đã chọn
    public static function statisticalByMonth($type, $month, $year)
    {
        $result = 1;
        $result_processed = 1;
        $customers = Customer::get();
        $bills = Bill::where('living_expenses_type_id', $type)
                        ->where('payment_year', $year)
                        ->where('payment_month', $month)
                        ->where('paid', 0)
                        ->get();
        return view('admin.paymentForServices.statistical', compact('result', 'result_processed', 'customers', 'bills'));
    } 
    
    // thống kê phí dịch vụ của một khách hàng theo một tháng đã chọn
    public static function statisticalByCustomerByMonth($type, $customer_Id, $month, $year)
    {
        $result = 1;
        $result_processed = 2;
        $customers = Customer::get();
        $customer = Customer::find($customer_Id);
        $bills = Bill::where('living_expenses_type_id', $type)
                        ->where('customer_id', $customer_Id)
                        ->where('payment_year', $year)
                        ->where('payment_month', $month)
                        ->where('paid', 0)
                        ->get();
        return view('admin.paymentForServices.statistical', compact('result', 'result_processed', 'customer', 'bills', 'customers'));
        
    }

    // thống kê phí dịch vụ của một khách hàng theo một khoảng thời gian từ tháng A đến tháng B
    public static function statisticalByCustomerByMonthToMonth($type, $customer_Id, $monthFrom, $yearFrom, $monthTo, $yearTo)
    {

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
