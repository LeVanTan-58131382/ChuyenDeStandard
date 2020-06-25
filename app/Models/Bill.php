<?php

namespace App\Models;
use App\Models\ConsumptionIndex;
use Illuminate\Http\Request;
use App\Models\UsageNormInvestors;
use App\Models\VehicleCuctomer;
use App\Models\VehiclePrice;
use App\Models\Comment;
use App\Models\OperationManagementFee;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bills';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'customer_id', 
        'living_expenses_type_id', 
        'price_regulation_id', 
        'payment_month',
        'payment_year', 
        'money_to_pay', 
        'usage_level_max', 
        'paid'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'customer_id', 'id');
    }

    protected static function addBill( Request $request, $id){
        Bill::addBillElectric($request, $id);
        Bill::addBillWater($request, $id);
        Bill::addBillCar($request, $id);
        Bill::addBillServices($request, $id);
    }

    protected static function addBillElectric(Request $request, $id){
        $celendar = SystemCalendar::find(1);
        $month = $celendar -> month;
        $year = $celendar -> year;

        $consumptionIndex_E_old = $request -> consumptionIndex_E_old;
        $consumptionIndex_E_new = $request -> consumptionIndex_E_new;
        $price_regulation_id_E = $request -> price_regulation_id_E; // mã quy định phí điện
        // tạo bảng chỉ số tiêu thụ
        $consumptionIndex_E = new ConsumptionIndex(); 
        $consumptionIndex_E -> customer_id = $id;
        $consumptionIndex_E -> living_expenses_type_id = 1;
        if($month > 1){
            $consumptionIndex_E -> month_consumption = $month-1;
            $consumptionIndex_E -> year_consumption = $year;
        }
        elseif($month == 1){
            $consumptionIndex_E -> month_consumption = 12;
            $consumptionIndex_E -> year_consumption = $year-1;
        }
        $consumptionIndex_E -> last_month_index = $consumptionIndex_E_old;
        $consumptionIndex_E -> this_month_index = $consumptionIndex_E_new;
        $consumptionIndex_E -> save();
        $consumptionIndex_E_final = $consumptionIndex_E_new - $consumptionIndex_E_old;
        // call
        $total_price_E = 0; // tổng tiền điện
        $e_level_max = 0;
        // tìm record mức sử dụng cao nhất
        $usage_E_level_max = UsageNormInvestors::where('living_expenses_type_id', 1)
                                                    ->where('price_regulation_id', $price_regulation_id_E)
                                                    ->where('usage_index_from', '<=', $consumptionIndex_E_final)
                                                    ->where('usage_index_to', '>=', $consumptionIndex_E_final)
                                                    ->get();
        // lấy level của mức
        foreach($usage_E_level_max as $e){
            $e_level_max = $e -> level;
            // tính tiền ở mức sử dụng cao nhất
            $total_price_E += ($consumptionIndex_E_final - $e -> usage_index_from + 1) * $e -> price;
            $consumptionIndex_E_final -= $consumptionIndex_E_final - $e -> usage_index_from + 1;
        }//
        for($i = $e_level_max-1; $i > 0; $i--){
            
            $usage_E_level = UsageNormInvestors::where('living_expenses_type_id', 1)
                                                    ->where('price_regulation_id', $price_regulation_id_E)
                                                    ->where('level', $i)
                                                    ->get();
            foreach($usage_E_level as $e){
                // tính tiền ở các mức sử dụng dưới
                $total_price_E += ($consumptionIndex_E_final - $e -> usage_index_from + 1) * $e -> price;
                $consumptionIndex_E_final -= $consumptionIndex_E_final - $e -> usage_index_from + 1;
            }
        }
        // tạo hóa đơn
        $billElectric = new Bill();
        $billElectric -> name = 'Hóa đơn phí điện sinh hoạt';
        $billElectric -> customer_id = $id;
        $billElectric -> living_expenses_type_id = 1;
        $billElectric -> price_regulation_id = $price_regulation_id_E;
        if($month > 1){
            $billElectric -> payment_month = $month-1;
            $billElectric -> payment_year = $year;
        }
        elseif($month == 1){
            $billElectric -> payment_month = 12;
            $billElectric -> payment_year = $year-1;
        }
        $billElectric -> money_to_pay = $total_price_E;
        $billElectric -> usage_level_max = $e_level_max;
        $billElectric -> save();
    }

    protected static function addBillWater(Request $request, $id){
        $celendar = SystemCalendar::find(1);
        $month = $celendar -> month;
        $year = $celendar -> year;

        $consumptionIndex_W_old = $request -> consumptionIndex_W_old;
        $consumptionIndex_W_new = $request -> consumptionIndex_W_new; 
        $price_regulation_id_W = $request -> price_regulation_id_W; // mã quy định phí nước
        // tạo bảng chỉ số tiêu thụ
        $consumptionIndex_W = new ConsumptionIndex(); 
        $consumptionIndex_W -> customer_id = $id;
        $consumptionIndex_W -> living_expenses_type_id = 2;
        if($month > 1){
            $consumptionIndex_W -> month_consumption = $month-1;
            $consumptionIndex_W -> year_consumption = $year;
        }
        elseif($month == 1){
            $consumptionIndex_W -> month_consumption = 12;
            $consumptionIndex_W -> year_consumption = $year-1;
        }
        $consumptionIndex_W -> last_month_index = $consumptionIndex_W_old;
        $consumptionIndex_W -> this_month_index = $consumptionIndex_W_new;
        $consumptionIndex_W -> save();
        $consumptionIndex_W_final = $consumptionIndex_W_new - $consumptionIndex_W_old;

        $total_price_W = 0; // tổng tiền nước
        $w_level_max = 0;
        // tìm record mức sử dụng cao nhất
        $usage_W_level_max = UsageNormInvestors::where('living_expenses_type_id', 2)
                                                    ->where('price_regulation_id', $price_regulation_id_W)
                                                    ->where('usage_index_from', '<=', $consumptionIndex_W_final)
                                                    ->where('usage_index_to', '>=', $consumptionIndex_W_final)
                                                    ->get();    
        // lấy level của mức
        foreach($usage_W_level_max as $w){
            $w_level_max = $w -> level;
            // tính tiền ở mức sử dụng cao nhất
            $total_price_W += ($consumptionIndex_W_final - $w -> usage_index_from + 1) * $w -> price;
            $consumptionIndex_W_final -= $consumptionIndex_W_final - $w -> usage_index_from + 1;
        }//
        for($i = $w_level_max-1; $i > 0; $i--){
            
            $usage_W_level = UsageNormInvestors::where('living_expenses_type_id', 2)
                                                    ->where('price_regulation_id', $price_regulation_id_W)
                                                    ->where('level', $i)
                                                    ->get();
            foreach($usage_W_level as $w){
                // tính tiền ở các mức sử dụng dưới
                $total_price_W += ($consumptionIndex_W_final - $w -> usage_index_from + 1) * $w -> price;
                $consumptionIndex_W_final -= $consumptionIndex_W_final - $w -> usage_index_from + 1;
            }
        }
        //tạo hóa đơn
        $billWater = new Bill();
        $billWater -> name = 'Hóa đơn phí nước sinh hoạt';
        $billWater -> customer_id = $id;
        $billWater -> living_expenses_type_id = 2;
        $billWater -> price_regulation_id = $price_regulation_id_W;
        if($month > 1){
            $billWater -> payment_month = $month-1;
            $billWater -> payment_year = $year;
        }
        elseif($month == 1){
            $billWater -> payment_month = 12;
            $billWater -> payment_year = $year-1;
        }
        
        $billWater -> money_to_pay = $total_price_W;
        $billWater -> usage_level_max = $w_level_max;
        $billWater -> save();
    }

    protected static function addBillCar( Request $request, $id){
        $celendar = SystemCalendar::find(1);
        $month = $celendar -> month;
        $year = $celendar -> year;

        $price_regulation_id_C = $request -> price_regulation_id_C; // mã quy định phí gửi xe
        // phương tiện
        // if($month > 1)
        // {
        //     $vehicles = VehicleCuctomer::where('customer_id', $id)
        //                         ->where('using', 1)
        //                         ->where([
        //                             ['year_use', '=', $year],
        //                             ['month_start_use', '=', $month-1],
        //                         ])->get();
        // }
        // elseif($month == 1)
        // {
        //     $vehicles = VehicleCuctomer::where('customer_id', $id)
        //                         ->where('using', 1)
        //                         ->where([
        //                             ['year_use', '=', $year-1],
        //                             ['month_start_use', '=', 12],
        //                         ])->get();
        // }
        $vehicles = VehicleCuctomer::where([['customer_id', '=', $id],
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
        $vehicle_prices = VehiclePrice::where('price_regulation_id', $price_regulation_id_C)->get();
        
        $total_price_C = 0; // tổng tiền gửi xe
        
        foreach($vehicles as $vehicle){
            foreach($vehicle_prices as $vehicle_price){
                // nếu có phương tiện là ô tô
                if($vehicle->vehicle_id == 1){
                    if($vehicle_price ->vehicle_type_id == 1){
                        $total_price_C += $vehicle->amount * $vehicle_price->price;
                    }
                }
                // nếu có phương tiện là mô tô
                if($vehicle->vehicle_id == 2){
                    if($vehicle_price ->vehicle_type_id == 2){
                        $total_price_C += $vehicle->amount * $vehicle_price->price;
                    }
                }
                // nếu có phương tiện là xe đạp
                if($vehicle->vehicle_id == 3){
                    if($vehicle_price ->vehicle_type_id == 3){
                        $total_price_C += $vehicle->amount * $vehicle_price->price;
                    }
                }
            }
        }
        if($vehicles->count() > 0)
        {
        $billCar = new Bill();
        $billCar -> name = 'Hóa đơn phí gửi xe';
        $billCar -> customer_id = $id;
        $billCar -> living_expenses_type_id = 3;
        $billCar -> price_regulation_id = $price_regulation_id_C;
        if($month > 1){
            $billCar -> payment_month = $month-1;
            $billCar -> payment_year = $year;
        }
        elseif($month == 1){
            $billCar -> payment_month = 12;
            $billCar -> payment_year = $year-1;
        }
        $billCar -> money_to_pay = $total_price_C;
        $billCar -> save();
        }
    }

    public static function addBillServices(Request $request, $id)
    {
        $celendar = SystemCalendar::find(1);
        $month = $celendar -> month;
        $year = $celendar -> year;

        $price_regulation_id_S = $request -> price_regulation_id_S; // mã quy định phí quản lý vận hành
        $services_prices = OperationManagementFee::where('price_regulation_id', $price_regulation_id_S)->get();

        //tạo hóa đơn
        $billServices = new Bill();
        $billServices -> name = 'Hóa đơn phí nước sinh hoạt';
        $billServices -> customer_id = $id;
        $billServices -> living_expenses_type_id = 4;
        $billServices -> price_regulation_id = $price_regulation_id_S;
        if($month > 1){
            $billServices -> payment_month = $month-1;
            $billServices -> payment_year = $year;
        }
        elseif($month == 1){
            $billServices -> payment_month = 12;
            $billServices -> payment_year = $year-1;
        }
        foreach($services_prices as $sp)
        {
            $billServices -> money_to_pay = $sp -> price;
        }
        
        $billServices -> save();
    }

}
