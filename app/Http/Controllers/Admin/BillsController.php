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

    public function postloadFileWater(Request $request)
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

            return redirect() -> back() -> with(['success'=>'Import thành công!!!']);

            // if(sizeof($collection[1]) == 4){ // 4 là số cột dữ liệu có trong file excel
            //     for($row=1; $row<sizeof($collection); $row++)
            //         try{
            //             //dd($collection[$row]);
            //         }catch(\Exception $e){
            //             return redirect()->back()
            //                 ->withErrors(['errors' => $e->getMessage()]);
            //         }
            //         return redirect() -> back() -> with(['success'=>'Import thành công!!!']);
            // }
            // else{
            //     return redirect()->back()
            //         ->withErrors(['errors' => [0 => 'Xin cung cấp đủ dữ liệu cho bảng dữ liệu.']]);
            // }
        }else{
            return redirect()->back()
                ->withErrors(['errors'=>$validator->errors()->all()]);
        }
    }

    public function postloadFileElectric(Request $request)
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

            return redirect() -> back() -> with(['success'=>'Import thành công!!!']);

            // if(sizeof($collection[1]) == 4){ // 4 là số cột dữ liệu có trong file excel
            //     for($row=1; $row<sizeof($collection); $row++)
            //         try{
            //             //dd($collection[$row]);
            //         }catch(\Exception $e){
            //             return redirect()->back()
            //                 ->withErrors(['errors' => $e->getMessage()]);
            //         }
            // return redirect() -> back() -> with(['success'=>'Import thành công!!!']);
            // }
            // else{
            //     return redirect()->back()
            //         ->withErrors(['errors' => [0 => 'Xin cung cấp đủ dữ liệu cho bảng dữ liệu.']]);
            // }
        }else{
            return redirect()->back()
                ->withErrors(['errors'=>$validator->errors()->all()]);
        }
    }

    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $calendar = SystemCalendar::find(1);
        $month = $calendar -> month;
        $year = $calendar -> year;
        if($month > 1)
        {
            $bills = Bill::where([['payment_year', '=', $year],['payment_month', '=', $month-1]])->get();
        }
        elseif($month == 1)
        {
            $bills = Bill::where([['payment_year', '=', $year-1],['payment_month', '=', 12]])->get();
        }
        
        $customers = Customer::paginate(30);
        $apartments = ApartmentAddress::get();
        return view('admin.paymentForServices.index', compact('bills', 'customers', 'apartments', 'month', 'calendar'));
    }
    
    public function createBill($customerId)
    {
        $calendar = SystemCalendar::find(1);
        $month = $calendar -> month;
        $year = $calendar -> year;
        $price_regulation_elects = PriceRegulation::where('living_expenses_type_id', 1)->get();
        $price_regulation_waters = PriceRegulation::where('living_expenses_type_id', 2)->get();
        $price_regulation_cars = PriceRegulation::where('living_expenses_type_id', 3)->get();
        $price_regulation_services = PriceRegulation::where('living_expenses_type_id', 4)->get();

        $customer_id = $customerId;
        $customer = Customer::find($customerId);
        $consumptionIndex_E_old = 0;
        $consumptionIndex_E_new = 0;
        $consumptionIndex_W_old = 0;
        $consumptionIndex_W_new = 0;
        // nếu khách hàng đạ dc xuất hóa đơn cho tháng 5 thì không xuất nữa
        if($month > 1)
        {   
            $bills = Bill::where([['customer_id','=', $customerId], ['payment_year','=', $year], ['payment_month','=', $month - 1]])->get();
        }
        elseif($month == 1)
        {
            $bills = Bill::where([['customer_id','=', $customerId], ['payment_year','=', $year-1], ['payment_month','=', 12]])->get();
        }
        
        if(!$bills->isEmpty()){
            return view('admin.paymentForServices.billexported', compact('calendar'));
        }

        // kiểm tra trong folder upload có file excel ko, nếu có thì load lên
        // file điện
        if($month > 1){
            $fileName = 'e'.($month-1).$year.'.xlsx';
        }
        elseif($month == 1)
        {
            $fileName = 'e'.'12'.($year-1).'.xlsx';
        }
        
        $savePath = public_path("upload\\");
        $excel = Importer::make('Excel');
        $excel->load($savePath.$fileName);
        //dd($excel['path']);
        
        try{
            // nếu có file excel thì ta thực hiện
            $collection = $excel->getCollection();
            for($row=1; $row<sizeof($collection); $row++)
            {
                if($collection[$row][0] == $customerId){
                    $consumptionIndex_E_old = $collection[$row][2];
                    $consumptionIndex_E_new = $collection[$row][3];
                }
                
            }
            }catch(\Exception $e){
            
            }

        // file nước
        if($month > 1){
            $fileName = 'w'.($month-1).$year.'.xlsx';
        }
        elseif($month == 1)
        {
            $fileName = 'w'.'12'.($year-1).'.xlsx';
        }
        $savePath = public_path("upload\\");
        $excel = Importer::make('Excel');
        $excel->load($savePath.$fileName);
        
        try{
            // nếu có file excel thì ta thực hiện
            $collection = $excel->getCollection();
            for($row=1; $row<sizeof($collection); $row++)
            {
                if($collection[$row][0] == $customerId){
                    $consumptionIndex_W_old = $collection[$row][2];
                    $consumptionIndex_W_new = $collection[$row][3];
                }
                
            }
            }catch(\Exception $e){
            
            }
        
        return view('admin.paymentForServices.detailPayment', compact('price_regulation_elects', 
                                                                        'price_regulation_waters', 
                                                                        'price_regulation_cars',
                                                                        'price_regulation_services', 
                                                                        'customer', 
                                                                        'customer_id', 
                                                                        'calendar',
                                                                        'consumptionIndex_E_old',
                                                                        'consumptionIndex_E_new',
                                                                        'consumptionIndex_W_old',
                                                                        'consumptionIndex_W_new'
                                                                    ));
    }

    public function storeBill(Request $request, $id)
    {
        $calendar = SystemCalendar::find(1);

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
        return redirect() -> route('admin.bills.index') -> with(['success'=>'Xuất hóa đơn thành công!!!']);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $calendar = SystemCalendar::find(1);
        $month = $calendar -> month;
        $year = $calendar -> year;

        $customer = Customer::find($id);

        if($month > 1)
        {
            $bills = Bill::where([['customer_id','=', $id], ['payment_year','=', $year], ['payment_month','=', $month - 1]])->get();
            $consumptionIndex_E = ConsumptionIndex::where([ ['customer_id', '=', $id], 
                                                            ['year_consumption', '=', $year], 
                                                            ['month_consumption', '=', $month-1],
                                                            ['living_expenses_type_id', '=', 1] ])
                                                            ->get();
            $consumptionIndex_W = ConsumptionIndex::where([ ['customer_id', '=', $id], 
                                                            ['year_consumption', '=', $year], 
                                                            ['month_consumption', '=', $month-1],
                                                            ['living_expenses_type_id', '=', 2] ])
                                                            ->get();
            $billElectric = Bill::where([   ['customer_id', $id],
                                            ['payment_year', $year],
                                            ['payment_month', $month-1],
                                            ['living_expenses_type_id', 1]])                 
                                            ->get();
            $billWater = Bill::where([  ['customer_id', $id],
                                        ['payment_year', $year],
                                        ['payment_month', $month-1],
                                        ['living_expenses_type_id', 2]])                 
                                        ->get();
            $billCar = Bill::where([    ['customer_id', $id],
                                        ['payment_year', $year],
                                        ['payment_month', $month-1],
                                        ['living_expenses_type_id', 3]])                 
                                        ->get();
            // $vehicles = VehicleCuctomer::where([
            //                             ['customer_id', $id],
            //                             ['using', '=', 1],
            //                             ['year_use', '=', $year],
            //                             ['month_start_use', '=', $month-1]])
            //                             ->get();
            $billServices = Bill::where([  ['customer_id', $id],
                                        ['payment_year', $year],
                                        ['payment_month', $month-1],
                                        ['living_expenses_type_id', 4]])                 
                                        ->get();
        }
        elseif($month == 1)
        {
            $bills = Bill::where([['customer_id','=', $id], ['payment_year','=', $year-1], ['payment_month','=', 12]])->get();
            $consumptionIndex_E = ConsumptionIndex::where([ ['customer_id', '=', $id], 
                                                            ['year_consumption', '=', $year-1], 
                                                            ['month_consumption', '=', 12],
                                                            ['living_expenses_type_id', '=', 1] ])
                                                            ->get();
            $consumptionIndex_W = ConsumptionIndex::where([ ['customer_id', '=', $id], 
                                                            ['year_consumption', '=', $year-1], 
                                                            ['month_consumption', '=', 12],
                                                            ['living_expenses_type_id', '=', 2] ])
                                                            ->get();
            $billElectric = Bill::where([   ['customer_id', $id],
                                            ['payment_year', $year-1],
                                            ['payment_month', 12],
                                            ['living_expenses_type_id', 1]])                 
                                            ->get();
            $billWater = Bill::where([  ['customer_id', $id],
                                        ['payment_year', $year-1],
                                        ['payment_month', 12],
                                        ['living_expenses_type_id', 2]])                 
                                        ->get();
            $billCar = Bill::where([    ['customer_id', $id],
                                        ['payment_year', $year-1],
                                        ['payment_month', 12],
                                        ['living_expenses_type_id', 3]])                 
                                        ->get();
            // $vehicles = VehicleCuctomer::where([
            //                             ['customer_id', $id],
            //                             ['using', '=', 1],
            //                             ['year_use', '=', $year-1],
            //                             ['month_start_use', '=', 12]])
            //                             ->get();
            $billServices = Bill::where([  ['customer_id', $id],
                                        ['payment_year', $year-1],
                                        ['payment_month', 12],
                                        ['living_expenses_type_id', 4]])                 
                                        ->get();
        }
        // nếu khách hàng chưa dc xuất hóa đơn cho tháng 5 thì hiển thị thông báo
        if($bills->isEmpty()){
            return view('admin.paymentForServices.billnotexported', compact('calendar'));
        }
        
        // $vehicles = VehicleCuctomer::select('*')->where('customer_id', $id)
        //                                         ->where('using', 1)
        //                                         ->where([
        //                                             ['year_use', '=', $year],
        //                                             ['month_start_use', '<=', $month],
        //                                         ])
        //                                         ->orWhere([
        //                                             ['year_use', '<', $year],
        //                                             ['month_start_use', '>=', $month],
        //                                         ])
        //                                         ->get();
        $vehicles = VehicleCuctomer::select('*')->where([['customer_id', '=', $id],
                                                         ['using', '=', 1]])
                                                ->where([
                                                    ['year_use', '=', $year],
                                                    ['month_start_use', '<', $month],
                                                ])
                                                ->orWhere([
                                                    ['year_use', '=', $year-1],
                                                    ['month_start_use', '>=', $month],
                                                ])
                                                ->orWhere([
                                                    ['year_use', '=', $year-1],
                                                    ['month_start_use', '<', $month],
                                                ])
                                                ->get(); // những phương tiện của khách hàng
        $vehicles_prices = VehiclePrice::get();
        
        $price_regulation = PriceRegulation::get();
        $usage_norm = UsageNormInvestors::get();
        return view('admin.paymentForServices.HoaDon', compact('customer', 'consumptionIndex_E', 'consumptionIndex_W', 'billElectric', 'billWater', 'billCar', 'billServices', 'price_regulation', 'vehicles', 'vehicles_prices', 'usage_norm', 'calendar'));
    }

    public function showBill($type)
    {
        $calendar = SystemCalendar::find(1);
        $month = $calendar -> month;
        $year = $calendar -> year;

        $customers = Customer::paginate(10);
        if($type == 1)
        {
            if($month > 1)
            {
                $bills = Bill::where([  ['living_expenses_type_id', '=', 1],
                                        ['payment_year', '=', $year],
                                        ['payment_month', '=', $month-1]])
                                        ->get();
            }
            elseif($month == 1)
            {
                $bills = Bill::where([  ['living_expenses_type_id', '=', 1],
                                        ['payment_year', '=', $year-1],
                                        ['payment_month', '=', 12]])
                                        ->get();
            }
            
            return view('admin.paymentForServices.billElectric', compact('bills', 'customers', 'calendar'));
        }
        if($type == 2)
        {
            if($month > 1)
            {
                $bills = Bill::where([  ['living_expenses_type_id', '=', 2],
                                        ['payment_year', '=', $year],
                                        ['payment_month', '=', $month-1]])
                                        ->get();
            }
            elseif($month == 1)
            {
                $bills = Bill::where([  ['living_expenses_type_id', '=', 2],
                                        ['payment_year', '=', $year-1],
                                        ['payment_month', '=', 12]])
                                        ->get();
            }
            return view('admin.paymentForServices.billWater', compact('bills', 'customers', 'calendar'));
        }
        if($type == 3)
        {
            if($month > 1)
            {
                $bills = Bill::where([  ['living_expenses_type_id', '=', 3],
                                        ['payment_year', '=', $year],
                                        ['payment_month', '=', $month-1]])
                                        ->get();
            }
            elseif($month == 1)
            {
                $bills = Bill::where([  ['living_expenses_type_id', '=', 3],
                                        ['payment_year', '=', $year-1],
                                        ['payment_month', '=', 12]])
                                        ->get();
            }
            return view('admin.paymentForServices.billCar', compact('bills', 'customers', 'calendar'));
        }
    } 
 
    public function showBillDetail( $type, $billID){
        $calendar = SystemCalendar::find(1);
        $month = $calendar -> month;
        $year = $calendar -> year;

        $bill = Bill::find($billID);
        $customer = Customer::find($bill -> customer_id);
        if($type == 1){
            if($month > 1)
            {
                $consumptionIndex_E = ConsumptionIndex::where([ ['customer_id', '=', $customer->id], 
                                                            ['year_consumption', '=', $year], 
                                                            ['month_consumption', '=', $month-1],
                                                            ['living_expenses_type_id', '=', 1] ])
                                                            ->get();
            }
            elseif($month == 1)
            {
                $consumptionIndex_E = ConsumptionIndex::where([ ['customer_id', '=', $customer->id], 
                                                            ['year_consumption', '=', $year-1], 
                                                            ['month_consumption', '=', 12],
                                                            ['living_expenses_type_id', '=', 1] ])
                                                            ->get();
            }
            
            $price_regulation = PriceRegulation::get();
            $usage_norm = UsageNormInvestors::get();
            return view('admin.paymentForServices.detailBillElectric', compact('consumptionIndex_E', 'bill', 'price_regulation', 'usage_norm', 'customer', 'calendar'));
        }
        if($type == 2){
            if($month > 1)
            {
                $consumptionIndex_W = ConsumptionIndex::where([ ['customer_id', '=', $customer->id], 
                                                            ['year_consumption', '=', $year], 
                                                            ['month_consumption', '=', $month-1],
                                                            ['living_expenses_type_id', '=', 2] ])
                                                            ->get();
            }
            elseif($month == 1)
            {
                $consumptionIndex_W = ConsumptionIndex::where([ ['customer_id', '=', $customer->id], 
                                                            ['year_consumption', '=', $year-1], 
                                                            ['month_consumption', '=', 12],
                                                            ['living_expenses_type_id', '=', 2] ])
                                                            ->get();
            }
            $price_regulation = PriceRegulation::get();
            $usage_norm = UsageNormInvestors::get();
            return view('admin.paymentForServices.detailBillWater', compact('consumptionIndex_W', 'bill', 'price_regulation', 'usage_norm', 'customer', 'calendar'));
        }
        if($type == 3){
            $vehicles = VehicleCuctomer::where([
                                                ['customer_id', '=', $customer->id],
                                                ['using', '=', 1],
                                                ['year_use', '=', $year],
                                                ['month_start_use', '<', $month],
                                            ])
                                            ->orWhere([
                                                ['customer_id', '=', $customer->id],
                                                ['using', '=', 1],
                                                ['year_use', '=', $year-1],
                                                ['month_start_use', '>=', $month],
                                            ])
                                            ->orWhere([
                                                ['customer_id', '=', $customer->id],
                                                ['using', '=', 1],
                                                ['year_use', '=', $year-1],
                                                ['month_start_use', '<', $month],
                                            ])
                                            ->get();
            $vehicles_prices = VehiclePrice::get();
            $price_regulation = PriceRegulation::get();
            return view('admin.paymentForServices.detailBillCar', compact( 'bill', 'price_regulation', 'vehicles', 'vehicles_prices', 'customer', 'calendar'));
        }
    }
    
    public function showBillPaid($type){
        $calendar = SystemCalendar::find(1);
        $month = $calendar -> month;
        $year = $calendar -> year;

        $customers = Customer::paginate(10);
        if($type == 1)
        {
            if($month > 1)
            {
                $bills = Bill::where([
                                        ['living_expenses_type_id', '=', 1],
                                        ['payment_year', '=', $year],
                                        ['payment_month', '=', $month-1],
                                        ['paid', '=', 1]])
                                        ->get();
            }
            elseif($month == 1)
            {
                $bills = Bill::where([
                                        ['living_expenses_type_id', '=', 1],
                                        ['payment_year', '=', $year-1],
                                        ['payment_month', '=', 12],
                                        ['paid', '=', 1]])
                                        ->get();
            }
            
            return view('admin.paymentForServices.billElectric', compact('bills', 'customers', 'calendar'));
        }
        if($type == 2)
        {
            if($month > 1)
            {
                $bills = Bill::where([
                                        ['living_expenses_type_id', '=', 2],
                                        ['payment_year', '=', $year],
                                        ['payment_month', '=', $month-1],
                                        ['paid', '=', 1]])
                                        ->get();
            }
            elseif($month == 1)
            {
                $bills = Bill::where([
                                        ['living_expenses_type_id', '=', 2],
                                        ['payment_year', '=', $year-1],
                                        ['payment_month', '=', 12],
                                        ['paid', '=', 1]])
                                        ->get();
            }
            return view('admin.paymentForServices.billWater', compact('bills', 'customers', 'calendar'));
        }
        if($type == 3)
        {
            if($month > 1)
            {
                $bills = Bill::where([
                                        ['living_expenses_type_id', '=', 3],
                                        ['payment_year', '=', $year],
                                        ['payment_month', '=', $month-1],
                                        ['paid', '=', 1]])
                                        ->get();
            }
            elseif($month == 1)
            {
                $bills = Bill::where([
                                        ['living_expenses_type_id', '=', 3],
                                        ['payment_year', '=', $year-1],
                                        ['payment_month', '=', 12],
                                        ['paid', '=', 1]])
                                        ->get();
            }
            return view('admin.paymentForServices.billCar', compact('bills', 'customers', 'calendar'));
        }
    }
    public function showBillNotPaid($type){
        $calendar = SystemCalendar::find(1);
        $month = $calendar -> month;
        $year = $calendar -> year;

        $customers = Customer::paginate(10);
        if($type == 1)
        {
            if($month > 1)
            {
                $bills = Bill::where([
                                        ['living_expenses_type_id', '=', 1],
                                        ['payment_year', '=', $year],
                                        ['payment_month', '=', $month-1],
                                        ['paid', '=', 0]])
                                        ->get();
            }
            elseif($month == 1)
            {
                $bills = Bill::where([
                                        ['living_expenses_type_id', '=', 1],
                                        ['payment_year', '=', $year-1],
                                        ['payment_month', '=', 12],
                                        ['paid', '=', 0]])
                                        ->get();
            }
            return view('admin.paymentForServices.billElectric', compact('bills', 'customers', 'calendar'));
        }
        if($type == 2)
        {
            if($month > 1)
            {
                $bills = Bill::where([
                                        ['living_expenses_type_id', '=', 2],
                                        ['payment_year', '=', $year],
                                        ['payment_month', '=', $month-1],
                                        ['paid', '=', 0]])
                                        ->get();
            }
            elseif($month == 1)
            {
                $bills = Bill::where([
                                        ['living_expenses_type_id', '=', 2],
                                        ['payment_year', '=', $year-1],
                                        ['payment_month', '=', 12],
                                        ['paid', '=', 0]])
                                        ->get();
            }
            return view('admin.paymentForServices.billWater', compact('bills', 'customers', 'calendar'));
        }
        if($type == 3)
        {
            if($month > 1)
            {
                $bills = Bill::where([
                                        ['living_expenses_type_id', '=', 3],
                                        ['payment_year', '=', $year],
                                        ['payment_month', '=', $month-1],
                                        ['paid', '=', 0]])
                                        ->get();
            }
            elseif($month == 1)
            {
                $bills = Bill::where([
                                        ['living_expenses_type_id', '=', 3],
                                        ['payment_year', '=', $year-1],
                                        ['payment_month', '=', 12],
                                        ['paid', '=', 0]])
                                        ->get();
            }
            return view('admin.paymentForServices.billCar', compact('bills', 'customers', 'calendar'));
        }
    }

    public function updateStatusPaid(Request $request, $billId, $typeBill){
        $bill = Bill::find($billId);
        if($typeBill == 1){
            if($request->updatePaidE == 1)
            {
                $bill->paid=1;
                $bill->save();
            }
            elseif($request->updatePaidE == 0)
            {
                $bill->paid=0;
                $bill->save();
            }
        }
        if($typeBill == 2){
            if($request->updatePaidW == 1)
            {
                $bill->paid=1;
                $bill->save();
            }
            elseif($request->updatePaidW == 0)
            {
                $bill->paid=0;
                $bill->save();
            }
        }
        if($typeBill == 3){
            if($request->updatePaidC == 1)
            {
                $bill->paid=1;
                $bill->save();
            }
            elseif($request->updatePaidC == 0)
            {
                $bill->paid=0;
                $bill->save();
            }
        }
        if($typeBill == 4){
            if($request->updatePaidS == 1)
            {
                $bill->paid=1;
                $bill->save();
            }
            elseif($request->updatePaidS == 0)
            {
                $bill->paid=0;
                $bill->save();
            }
        }
        return redirect()->back()->with(['success'=>'Cập nhật tình trạng thanh toán thành công!']);
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
