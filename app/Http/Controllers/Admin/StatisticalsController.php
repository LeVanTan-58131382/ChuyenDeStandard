<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\SystemCalendar;

class StatisticalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $celendar = SystemCalendar::find(1);
        $customers = Customer::get();
        $result = 0;
        $result_processed = 0;
        return view('admin.paymentForServices.statisticalMonth', compact('customers', 'result', 'result_processed', 'celendar'));
    }

    public function statisticalMonthToMonth(){
        $celendar = SystemCalendar::find(1);
        $customers = Customer::get();
        $result = 0;
        $result_processed = 0;
        return view('admin.paymentForServices.statisticalMonthToMonth', compact('customers', 'result', 'result_processed', 'celendar'));
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
        if( $customer_Id == 0 && $month != 0 && $year != 0 && $monthFrom == 0 && $yearFrom == 0 && $monthTo == 0 && $yearTo == 0)
        {
            return $this::statisticalByMonth($type, $month, $year);
        }

        // thống kê phí dịch vụ của một khách hàng theo một tháng đã chọn
        elseif( $customer_Id != 0 && $month != 0 && $monthFrom == 0 && $yearFrom == 0 && $monthTo == 0 && $yearTo == 0)
        {
            return $this::statisticalByCustomerByMonth($type, $customer_Id, $month, $year);
        }

        // thống kê phí dịch vụ của một khách hàng theo một khoảng thời gian từ tháng A đến tháng B
        elseif( $customer_Id != 0 && $monthFrom != 0 && $yearFrom != 0 && $monthTo != 0 && $yearTo != 0)
        {
            return $this::statisticalByCustomerByMonthToMonth($type, $customer_Id, $monthFrom, $yearFrom, $monthTo, $yearTo);
        }

        // thống kê phí dịch vụ của tất cả khách hàng theo một khoảng thời gian từ tháng A đến tháng B
        elseif( $customer_Id == 0 && $monthFrom != 0 && $yearFrom != 0 && $monthTo != 0 && $yearTo != 0)
        {
            return $this::statisticalByAllCustomerByMonthToMonth($type, $customer_Id, $monthFrom, $yearFrom, $monthTo, $yearTo);
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
        $celendar = SystemCalendar::find(1);
        if($type == 1){
            $title = 'Thống kê phí dịch vụ Điện sinh hoạt của các hộ trong tháng '.$month;
        }
        if($type == 2){
            $title = 'Thống kê phí dịch vụ Nước sinh hoạt của các hộ trong tháng '.$month;
        }
        if($type == 3){
            $title = 'Thống kê phí dịch vụ gửi xe của các hộ trong tháng '.$month;
        }
        $bills = Bill::where('living_expenses_type_id', $type)
                        ->where('payment_year', $year)
                        ->where('payment_month', $month)
                        ->where('paid', 0)
                        ->get();
        return view('admin.paymentForServices.statisticalMonth', compact('result', 'result_processed', 'customers', 'bills', 'title', 'celendar'));
    } 
    
    // thống kê phí dịch vụ của một khách hàng theo một tháng đã chọn
    public static function statisticalByCustomerByMonth($type, $customer_Id, $month, $year)
    {
        $result = 1;
        $result_processed = 2;
        $celendar = SystemCalendar::find(1);
        $customers = Customer::get();
        $customer_result = Customer::find($customer_Id);
        $name = $customer_result -> name;
        if($type == 1){
            $title = 'Thống kê phí dịch vụ Điện sinh hoạt của '.$name.' trong tháng '.$month;
        }
        if($type == 2){
            $title = 'Thống kê phí dịch vụ Nước sinh hoạt của '.$name.' trong tháng '.$month;
        }
        if($type == 3){
            $title = 'Thống kê phí dịch vụ gửi xe của '.$name.' trong tháng '.$month;
        }
        
        $bills = Bill::where('living_expenses_type_id', $type)
                        ->where('customer_id', $customer_Id)
                        ->where('payment_year', $year)
                        ->where('payment_month', $month)
                        ->where('paid', 0)
                        ->get();
        return view('admin.paymentForServices.statisticalMonth', compact('result', 'result_processed', 'customer_result', 'bills', 'customers', 'title', 'celendar'));
    }

    // thống kê phí dịch vụ của một khách hàng theo một khoảng thời gian từ tháng A đến tháng B
    public static function statisticalByCustomerByMonthToMonth($type, $customer_Id, $monthFrom, $yearFrom, $monthTo, $yearTo)
    {
        $result = 1;
        $result_processed = 2;
        $customers = Customer::get();
        $customer_result = Customer::find($customer_Id);
        $celendar = SystemCalendar::find(1);
        if($type == 1){
            $title = 'Thống kê phí dịch vụ Điện sinh hoạt của '. $customer_result -> name .' từ tháng '.$monthFrom.' đến tháng '.$monthTo;
        }
        if($type == 2){
            $title = 'Thống kê phí dịch vụ Nước sinh hoạt của '. $customer_result -> name .' từ tháng '.$monthFrom.' đến tháng '.$monthTo;
        }
        if($type == 3){
            $title = 'Thống kê phí dịch vụ gửi xe của '. $customer_result -> name .' từ tháng '.$monthFrom.' đến tháng '.$monthTo;
        }
        $bills = Bill::where('living_expenses_type_id', $type)
                        ->where('customer_id', $customer_Id)
                        ->where('payment_year', '>=' , $yearFrom)
                        ->where('payment_year', '<=' , $yearTo)
                        ->where('payment_month', '>=' , $monthFrom)
                        ->where('payment_month', '<=' , $monthTo)
                        ->where('paid', 0)
                        ->get();
        return view('admin.paymentForServices.statisticalMonthToMonth', compact('result', 'result_processed', 'customers', 'customer_result', 'bills', 'title', 'celendar'));
    }

    public static function statisticalByAllCustomerByMonthToMonth($type, $customer_Id, $monthFrom, $yearFrom, $monthTo, $yearTo)
    {
        $result = 1;
        $result_processed = 3;
        $customers = Customer::get();
        $celendar = SystemCalendar::find(1);
        if($type == 1){
            $title = 'Thống kê phí dịch vụ Điện sinh hoạt của các hộ từ tháng '.$monthFrom.' đến tháng '.$monthTo;
        }
        if($type == 2){
            $title = 'Thống kê phí dịch vụ Nước sinh hoạt của các hộ từ tháng '.$monthFrom.' đến tháng '.$monthTo;
        }
        if($type == 3){
            $title = 'Thống kê phí dịch vụ gửi xe của các hộ từ tháng '.$monthFrom.' đến tháng '.$monthTo;
        }
        $bills = Bill::where('living_expenses_type_id', $type)
                        ->where('payment_year', '>=' , $yearFrom)
                        ->where('payment_year', '<=' , $yearTo)
                        ->where('payment_month', '>=' , $monthFrom)
                        ->where('payment_month', '<=' , $monthTo)
                        ->where('paid', 0)
                        ->get();
        return view('admin.paymentForServices.statisticalMonthToMonth', compact('result', 'result_processed', 'customers', 'bills', 'title', 'celendar'));
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
