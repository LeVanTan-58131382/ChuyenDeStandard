<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\ApartmentAddress;
use App\Models\Customer;
use App\Models\PriceRegulation;
use App\Models\SystemCalendar;
use Validator;
use App\Models\ConsumptionIndex;
use App\Models\VehicleCuctomer;
use App\Models\UsageNormInvestors;
use App\Models\VehiclePrice;

class BillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $celendar = SystemCalendar::find(1);
        $month = $celendar -> month;
        $bills = Bill::get();
        $customers = Customer::paginate(10);
        $apartments = ApartmentAddress::get();
        return view('admin.paymentForServices.index', compact('bills', 'customers', 'apartments', 'month'));
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

        // foreach($customer->vehicles as $vehicle){
        //     if($vehicle->pivot->vehicle_id == 1)
        //     {echo('Số lượng xe ô tô là: '.$vehicle->pivot->amount);}
        // }
        // die();
        
        return view('admin.paymentForServices.detailPayment', compact('price_regulation_elects', 'price_regulation_waters', 'price_regulation_cars', 'customer', 'customer_id'));
    }

    public function storeBill(Request $request, $id)
    {
        $consumptionIndex_E_old = $request -> consumptionIndex_E_old;
        $consumptionIndex_E_new = $request -> consumptionIndex_E_new;
        $consumptionIndex_W_old = $request -> consumptionIndex_W_old;
        $consumptionIndex_W_new = $request -> consumptionIndex_W_new; 

        $input = $request->all(); 
        $this->rules =[
            "consumptionIndex_E_old" => "required",
            "consumptionIndex_E_new" => "required",
            "consumptionIndex_W_old" => "required",
            "consumptionIndex_W_new" => "required"
        ];
        $validate = Validator::make($input, $this->rules);
        
        if($consumptionIndex_E_old > $consumptionIndex_E_new || $consumptionIndex_W_old > $consumptionIndex_W_new){
            return redirect()->back()->withErrors(['errors'=>'Một hoặc nhiều chỉ số bạn nhập chưa chính xác!!!']);
        }
        if($validate->fails()){

            return redirect()->back()->withErrors(['errors'=>'Một hoặc nhiều chỉ số bạn chưa nhập!!!']);
        }

        Bill::addBill($request, $id);
        return redirect() -> route('admin.bills.index') -> with(['success'=>'Xóa hóa đơn thành công!!!']);
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
        $celendar = SystemCalendar::find(1);
        $month = $celendar -> month;
        $year = $celendar -> year;

        $customer = Customer::find($id);

        $bills = Bill::select('*')->where('customer_id', $id)->where('payment_month', $month)
                                                            ->where('payment_year', $year)
                                                            ->get();
        // nếu khách hàng đạ dc xuất hóa đơn cho tháng 5 thì không xuất nữa
        if($bills->isEmpty()){
            return view('admin.paymentForServices.billnotexported');
        }
        $consumptionIndex_E = ConsumptionIndex::select('*')->where('customer_id', $id)
                                                            ->where('year_consumption', $year)
                                                            ->where('month_consumption', $month)
                                                            ->where('living_expenses_type_id', 1)
                                                            ->get();
        $consumptionIndex_W = ConsumptionIndex::select('*')->where('customer_id', $id)
                                                            ->where('year_consumption', $year)
                                                            ->where('month_consumption', $month)
                                                            ->where('living_expenses_type_id', 2)
                                                            ->get();
        $vehicles = VehicleCuctomer::select('*')->where('customer_id', $id)->get();
        $vehicles_prices = VehiclePrice::get();
        $billElectric = Bill::select('*')->where('customer_id', $id)
                                        ->where('payment_year', $year)
                                        ->where('payment_month', $month)
                                        ->where('living_expenses_type_id', 1)
                                        ->get();
        $billWater = Bill::select('*')->where('customer_id', $id)
                                        ->where('payment_year', $year)
                                        ->where('payment_month', $month)
                                        ->where('living_expenses_type_id', 2)
                                        ->get();
        $billCar = Bill::select('*')->where('customer_id', $id)
                                        ->where('payment_year', $year)
                                        ->where('payment_month', $month)
                                        ->where('living_expenses_type_id', 3)
                                        ->get();
        $price_regulation = PriceRegulation::get();
        $usage_norm = UsageNormInvestors::get();
        return view('admin.paymentForServices.HoaDon', compact('customer', 'consumptionIndex_E', 'consumptionIndex_W', 'billElectric', 'billWater', 'billCar', 'price_regulation', 'vehicles', 'vehicles_prices', 'usage_norm'));
    }

    public function showBill($type)
    {
        $celendar = SystemCalendar::find(1);
        $month = $celendar -> month;
        $year = $celendar -> year;

        $customers = Customer::paginate(10);
        if($type == 1)
        {
            $bills = Bill::select('*')->where('living_expenses_type_id', 1)
                                        ->where('payment_year', $year)
                                        ->where('payment_month', $month)
                                        ->get();
            return view('admin.paymentForServices.billElectric', compact('bills', 'customers'));
        }
        if($type == 2)
        {
            $bills = Bill::select('*')->where('living_expenses_type_id', 2)
                                        ->where('payment_year', $year)
                                        ->where('payment_month', $month)
                                        ->get();
            return view('admin.paymentForServices.billWater', compact('bills', 'customers'));
        }
        if($type == 3)
        {
            $bills = Bill::select('*')->where('living_expenses_type_id', 3)
                                        ->where('payment_year', $year)
                                        ->where('payment_month', $month)
                                        ->get();
            return view('admin.paymentForServices.billCar', compact('bills', 'customers'));
        }
    }
 
    public function showBillDetail( $type, $billID){
        $celendar = SystemCalendar::find(1);
        $month = $celendar -> month;
        $year = $celendar -> year;

        $bill = Bill::find($billID);
        $customer = Customer::find($bill -> customer_id);
        if($type == 1){
            $consumptionIndex_E = ConsumptionIndex::select('*')->where('customer_id', $customer->id)
                                                                ->where('year_consumption', $year)
                                                                ->where('month_consumption', $month)
                                                                ->where('living_expenses_type_id', 1)->get();
            $price_regulation = PriceRegulation::get();
            $usage_norm = UsageNormInvestors::get();
            return view('admin.paymentForServices.detailBillElectric', compact('consumptionIndex_E', 'bill', 'price_regulation', 'usage_norm', 'customer'));
        }
        if($type == 2){
            $consumptionIndex_W = ConsumptionIndex::select('*')->where('customer_id', $customer->id)
                                                                ->where('year_consumption', $year)
                                                                ->where('month_consumption', 5)
                                                                ->where('living_expenses_type_id', 2)->get();
            $price_regulation = PriceRegulation::get();
            $usage_norm = UsageNormInvestors::get();
            return view('admin.paymentForServices.detailBillWater', compact('consumptionIndex_W', 'bill', 'price_regulation', 'usage_norm', 'customer'));
        }
        if($type == 3){
            $vehicles = VehicleCuctomer::select('*')->where('customer_id', $customer->id)->get();
            $vehicles_prices = VehiclePrice::get();
            $price_regulation = PriceRegulation::get();
            return view('admin.paymentForServices.detailBillCar', compact( 'bill', 'price_regulation', 'vehicles', 'vehicles_prices', 'customer'));
        }
    }
    

    public function showBillPaid($type){
        $celendar = SystemCalendar::find(1);
        $month = $celendar -> month;
        $year = $celendar -> year;

        $customers = Customer::paginate(10);
        if($type == 1)
        {
            $bills = Bill::select('*')->where('living_expenses_type_id', 1)
                                        ->where('payment_year', $year)
                                        ->where('payment_month', $month)
                                        ->where('paid', 1)
                                        ->get();
            return view('admin.paymentForServices.billElectric', compact('bills', 'customers'));
        }
        if($type == 2)
        {
            $bills = Bill::select('*')->where('living_expenses_type_id', 2)
                                        ->where('payment_year', $year)
                                        ->where('payment_month', $month)
                                        ->where('paid', 1)
                                        ->get();
            return view('admin.paymentForServices.billWater', compact('bills', 'customers'));
        }
        if($type == 3)
        {
            $bills = Bill::select('*')->where('living_expenses_type_id', 3)
                                        ->where('payment_year', $year)
                                        ->where('payment_month', $month)
                                        ->where('paid', 1)
                                        ->get();
            return view('admin.paymentForServices.billCar', compact('bills', 'customers'));
        }
    }
    public function showBillNotPaid($type){
        $celendar = SystemCalendar::find(1);
        $month = $celendar -> month;
        $year = $celendar -> year;

        $customers = Customer::paginate(10);
        if($type == 1)
        {
            $bills = Bill::select('*')->where('living_expenses_type_id', 1)
                                        ->where('payment_year', $year)
                                        ->where('payment_month', $month)
                                        ->where('paid', 0)
                                        ->get();
            return view('admin.paymentForServices.billElectric', compact('bills', 'customers'));
        }
        if($type == 2)
        {
            $bills = Bill::select('*')->where('living_expenses_type_id', 2)
                                        ->where('payment_year', $year)
                                        ->where('payment_month', $month)
                                        ->where('paid', 0)
                                        ->get();
            return view('admin.paymentForServices.billWater', compact('bills', 'customers'));
        }
        if($type == 3)
        {
            $bills = Bill::select('*')->where('living_expenses_type_id', 3)
                                        ->where('payment_year', $year)
                                        ->where('payment_month', $month)
                                        ->where('paid', 0)
                                        ->get();
            return view('admin.paymentForServices.billCar', compact('bills', 'customers'));
        }
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
