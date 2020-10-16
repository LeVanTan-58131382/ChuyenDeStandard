<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bill;

use App\Models\Customer;
use App\Models\PriceRegulation;
use App\Models\SystemCalendar;

use App\Models\ConsumptionIndex;
use App\Models\VehicleCuctomer;
use App\Models\UsageNormInvestors;
use App\Models\VehiclePrice;
use App\Models\Comment;

class BillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function allBills($customerId, $billMonth, $billYear){
       
        $calendar = SystemCalendar::find(1);
        $month = $calendar -> month;
        $year = $calendar -> year;

        $customer = Customer::find($customerId);
        if($billMonth == 0 && $billYear == 0)
        {
            if($month > 1)
            {
                $bills = Bill::where([['customer_id','=', $customerId], ['payment_year','=', $year], ['payment_month','=', $month - 1]])->get();
                $consumptionIndex_E = ConsumptionIndex::where([ ['customer_id', '=', $customerId], 
                                                                ['year_consumption', '=', $year], 
                                                                ['month_consumption', '=', $month-1],
                                                                ['living_expenses_type_id', '=', 1] ])
                                                                ->get();
                $consumptionIndex_W = ConsumptionIndex::where([ ['customer_id', '=', $customerId], 
                                                                ['year_consumption', '=', $year], 
                                                                ['month_consumption', '=', $month-1],
                                                                ['living_expenses_type_id', '=', 1] ])
                                                                ->get();
                $billElectric = Bill::where([   ['customer_id', $customerId],
                                                ['payment_year', $year],
                                                ['payment_month', $month-1],
                                                ['living_expenses_type_id', 1]])                 
                                                ->get();
                $billWater = Bill::where([  ['customer_id', $customerId],
                                            ['payment_year', $year],
                                            ['payment_month', $month-1],
                                            ['living_expenses_type_id', 2]])                 
                                            ->get();
                $billCar = Bill::where([    ['customer_id', $customerId],
                                            ['payment_year', $year],
                                            ['payment_month', $month-1],
                                            ['living_expenses_type_id', 3]])                 
                                            ->get();
                $billServices = Bill::where([    ['customer_id', $customerId],
                                            ['payment_year', $year],
                                            ['payment_month', $month-1],
                                            ['living_expenses_type_id', 4]])                 
                                            ->get();
                // $vehicles = VehicleCuctomer::where([
                //                             ['customer_id', $customerId],
                //                             ['using', '=', 1],
                //                             ['year_use', '=', $year],
                //                             ['month_start_use', '=', $month-1]])
                //                             ->get();
            }
            elseif($month == 1)
            {
                $bills = Bill::where([['customer_id','=', $customerId], ['payment_year','=', $year-1], ['payment_month','=', 12]])->get();
                $consumptionIndex_E = ConsumptionIndex::where([ ['customer_id', '=', $customerId], 
                                                                ['year_consumption', '=', $year-1], 
                                                                ['month_consumption', '=', 12],
                                                                ['living_expenses_type_id', '=', 1] ])
                                                                ->get();
                $consumptionIndex_W = ConsumptionIndex::where([ ['customer_id', '=', $customerId], 
                                                                ['year_consumption', '=', $year-1], 
                                                                ['month_consumption', '=', 12],
                                                                ['living_expenses_type_id', '=', 1] ])
                                                                ->get();
                $billElectric = Bill::where([   ['customer_id', $customerId],
                                                ['payment_year', $year-1],
                                                ['payment_month', 12],
                                                ['living_expenses_type_id', 1]])                 
                                                ->get();
                $billWater = Bill::where([  ['customer_id', $customerId],
                                            ['payment_year', $year-1],
                                            ['payment_month', 12],
                                            ['living_expenses_type_id', 2]])                 
                                            ->get();
                $billCar = Bill::where([    ['customer_id', $customerId],
                                            ['payment_year', $year-1],
                                            ['payment_month', 12],
                                            ['living_expenses_type_id', 3]])                 
                                            ->get();
                $billServices = Bill::where([    ['customer_id', $customerId],
                                            ['payment_year', $year-1],
                                            ['payment_month', 12],
                                            ['living_expenses_type_id', 4]])                 
                                            ->get();

                // $vehicles = VehicleCuctomer::where([
                //                             ['customer_id', $customerId],
                //                             ['using', '=', 1],
                //                             ['year_use', '=', $year-1],
                //                             ['month_start_use', '=', 12]])
                //                             ->get();
            }
        }
        elseif($billMonth != 0 && $billYear != 0)
        {
            $bills = Bill::where([['customer_id','=', $customerId], ['payment_year','=', $billYear], ['payment_month','=', $billMonth]])->get();
                $consumptionIndex_E = ConsumptionIndex::where([ ['customer_id', '=', $customerId], 
                                                                ['year_consumption', '=', $billYear], 
                                                                ['month_consumption', '=', $billMonth],
                                                                ['living_expenses_type_id', '=', 1] ])
                                                                ->get();
                
                $consumptionIndex_W = ConsumptionIndex::where([ ['customer_id', '=', $customerId], 
                                                                ['year_consumption', '=', $billYear], 
                                                                ['month_consumption', '=', $billMonth],
                                                                ['living_expenses_type_id', '=', 1] ])
                                                                ->get();
                $billElectric = Bill::where([   ['customer_id', $customerId],
                                                ['payment_year', $billYear],
                                                ['payment_month', $billMonth],
                                                ['living_expenses_type_id', 1]])                 
                                                ->get();
                $billWater = Bill::where([  ['customer_id', $customerId],
                                            ['payment_year', $billYear],
                                            ['payment_month', $billMonth],
                                            ['living_expenses_type_id', 2]])                 
                                            ->get();
                $billCar = Bill::where([    ['customer_id', $customerId],
                                            ['payment_year', $billYear],
                                            ['payment_month', $billMonth],
                                            ['living_expenses_type_id', 3]])                 
                                            ->get();
                $billServices = Bill::where([    ['customer_id', $customerId],
                                            ['payment_year', $billYear],
                                            ['payment_month', $billMonth],
                                            ['living_expenses_type_id', 4]])                 
                                            ->get();
        }
        // nếu khách hàng chưa dc xuất hóa đơn cho tháng 5 thì hiển thị thông báo
        if($bills->isEmpty()){
            return view('customer.bill.billnotexported', compact('calendar'));
        }
        $vehicles = VehicleCuctomer::select('*')->where([['customer_id', '=', $customerId],
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

        // lấy những comment của khách hàng về bill của kh
        $idBillE = 0;
        $idBillW = 0;
        foreach($billElectric as $bill){
            $idBillE = $bill->id;
        }
        foreach($billWater as $bill){
            $idBillW = $bill->id;
        }
        
        $strIdBill = $idBillE.'-'.$idBillW;
    
        $comments = Comment::select('*')->orderBy('created_at', 'asc')->get();
  
        return view('customer.bill.bill', compact('customer', 'consumptionIndex_E', 'consumptionIndex_W', 'billElectric', 'billWater', 'billCar', 'billServices', 'price_regulation', 'vehicles', 'vehicles_prices', 'usage_norm', 'calendar', 'comments'));
    }
    public function historyBills($customerId){
        $customer = Customer::find($customerId);
        $bills = Bill::where('customer_id', $customerId)->get();
        return view('customer.bill.history', compact('bills', 'customer'));
    }
}
