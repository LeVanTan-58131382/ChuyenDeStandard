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
use Importer;

class BillsController extends Controller
{
    public function getloadFile()
    {
        return view('admin.paymentForServices.testExcel');
    }

    public function postloadFile(Request $request)
    {
        // đã đọc dc file excel
        $validator = Validator::make($request->all(), [
            'file' => 'required|max:5000|mimes:xlsx,xls,csv'
        ]);

        if($validator->passes()){

            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $savePath = public_path('/upload/');
            $file->move($savePath, $fileName);

            $excel = Importer::make('Excel');
            $excel->load($savePath.$fileName);
            $collection = $excel->getCollection();

            if(sizeof($collection[1]) == 3){
                for($row=1; $row<sizeof($collection); $row++)
                    try{
                        dd($collection[$row]);
                    }catch(\Exception $e){
                        return redirect()->back()
                            ->with(['errors' => $e->getMessage()]);
                    }
            }else{
                return redirect()->back()
                    ->with(['errors' => [0 => 'Please provide data in file according to sample file.']]);
            }
        }else{
            return redirect()->back()
                ->with(['errors'=>$validator->errors()->all()]);
        }
    }



    public function index()
    {
        $celendar = SystemCalendar::find(1);
        $month = $celendar -> month;
        $year = $celendar -> year;
        $bills = Bill::where('payment_year', $year)->where('payment_month', $month)->get();
        $customers = Customer::paginate(10);
        $apartments = ApartmentAddress::get();
        return view('admin.paymentForServices.index', compact('bills', 'customers', 'apartments', 'month'));
    }

    public function create()
    {
        //
    }
    
    public function createBill($customerId)
    {
        $celendar = SystemCalendar::find(1);
        $month = $celendar -> month;
        $year = $celendar -> year;
        // nếu khách hàng đạ dc xuất hóa đơn cho tháng 5 thì không xuất nữa
        $bills = Bill::select('*')->where('customer_id', $customerId)->where('payment_year', $year)->where('payment_month', $month)->get();
        if(!$bills->isEmpty()){
            return view('admin.paymentForServices.billexported');
        }

        $price_regulation_elects = PriceRegulation::select('*')->where('living_expenses_type_id', 1)->get();
        $price_regulation_waters = PriceRegulation::select('*')->where('living_expenses_type_id', 2)->get();
        $price_regulation_cars = PriceRegulation::select('*')->where('living_expenses_type_id', 3)->get();
        $customer_id = $customerId;
        $customer = Customer::find($customerId);
        
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

    public function store(Request $request)
    {
        //
    }

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
        $vehicles = VehicleCuctomer::select('*')->where('customer_id', $id)
                                                ->where('using', 1)
                                                ->where([
                                                    ['year_use', '=', $year],
                                                    ['month_start_use', '<=', $month],
                                                ])
                                                ->orWhere([
                                                    ['year_use', '<', $year],
                                                    ['month_start_use', '>=', $month],
                                                ])
                                                ->get();
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
                                                                ->where('month_consumption', $month)
                                                                ->where('living_expenses_type_id', 2)->get();
            $price_regulation = PriceRegulation::get();
            $usage_norm = UsageNormInvestors::get();
            return view('admin.paymentForServices.detailBillWater', compact('consumptionIndex_W', 'bill', 'price_regulation', 'usage_norm', 'customer'));
        }
        if($type == 3){
            $vehicles = VehicleCuctomer::select('*')->where('customer_id', $customer->id)
                                                    ->where('using', 1)
                                                    ->where([
                                                        ['year_use', '=', $year],
                                                        ['month_start_use', '<=', $month],
                                                    ])
                                                    ->orWhere([
                                                        ['year_use', '<', $year],
                                                        ['month_start_use', '>=', $month],
                                                    ])
                                                    ->get();
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

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
