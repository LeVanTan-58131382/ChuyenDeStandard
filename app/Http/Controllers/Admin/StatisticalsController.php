<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApartmentAddress;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\SystemCalendar;

class StatisticalsController extends Controller
{
    public function index(Request $request)
    { // thống kê theo mốc thời gian
        $request->user()->authorizeRoles(['admin']);
        $calendar = SystemCalendar::find(1);
        $result = 0;
        $result_processed = 0;
        return view('admin.paymentForServices.statisticalMonth', compact( 'result', 'result_processed', 'calendar'));
    }

    public function statisticalMonthToMonth(){
        // thống kê theo khoảng thời gian
        $calendar = SystemCalendar::find(1);
        $result = 0;
        $result_processed = 0;
        return view('admin.paymentForServices.statisticalMonthToMonth', compact( 'result', 'result_processed', 'calendar'));
    }

    public function statistical(Request $request)
    {
        $typeServices = $request -> type;
        $block = $request -> block;
        $floor = $request -> floor;
        $month = $request -> month;
        $year = $request -> year;
        $monthFrom = $request -> monthFrom;
        $yearFrom = $request -> yearFrom;
        $monthTo = $request -> monthTo;
        $yearTo = $request -> yearTo;

        // thống kê tất cả các loại phí của tất cả block và tầng theo tháng nhất định
        // if($type == 0 && $block == 0 && $floor == 0)
        // {

        // }
        // // thống kê tất cả các loại phí của một block hay một floor nào đó theo tháng nhất định
        // elseif($type == 0)
        // {
        //     if($block != 0 && $floor != 0)
        //     {

        //     }
        //     if($block == 0 && $floor != 0)
        //     {
                
        //     }
        //     if($block != 0 && $floor == 0)
        //     {
                
        //     }
        // }
        // // thống kê một loại phí của của tất cả block và tầng theo tháng nhất định
        // elseif($type != 0 && $block == 0 && $floor == 0)
        // {
            
        // }
        // // thống kê một loại phí của một block hay một floor nào đó theo tháng nhất định
        // elseif($type != 0)
        // {
        //     if($block != 0 && $floor != 0)
        //     {

        //     }
        //     if($block == 0 && $floor != 0)
        //     {
                
        //     }
        //     if($block != 0 && $floor == 0)
        //     {
                
        //     }
        // }
        return $this::statisticalServicesByBlockFloorByMonth($typeServices, $block, $floor, $year, $month);



        // thống kê tất cả các loại phí của tất cả block và tầng từ tháng A đến tháng B

        // thống kê tất cả các loại phí của một block hay một floor nào đó từ tháng A đến tháng B

        // thống kê một loại phí của của tất cả block và tầng từ tháng A đến tháng B

        // thống kê một loại phí của một block hay một floor nào đó từ tháng A đến tháng B




        // thống kê một loại phí dịch vụ theo một tháng đã chọn của tất cả khách hàng
        // if( $customer_Id == 0 && $month != 0 && $year != 0 && $monthFrom == 0 && $yearFrom == 0 && $monthTo == 0 && $yearTo == 0)
        // {
        //     return $this::statisticalByMonth($type, $month, $year);
        // }

        // // thống kê phí dịch vụ của một khách hàng theo một tháng đã chọn
        // elseif( $customer_Id != 0 && $month != 0 && $monthFrom == 0 && $yearFrom == 0 && $monthTo == 0 && $yearTo == 0)
        // {
        //     return $this::statisticalByCustomerByMonth($type, $customer_Id, $month, $year);
        // }

        // // thống kê phí dịch vụ của một khách hàng theo một khoảng thời gian từ tháng A đến tháng B
        // elseif( $customer_Id != 0 && $monthFrom != 0 && $yearFrom != 0 && $monthTo != 0 && $yearTo != 0)
        // {
        //     return $this::statisticalByCustomerByMonthToMonth($type, $customer_Id, $monthFrom, $yearFrom, $monthTo, $yearTo);
        // }

        // // thống kê phí dịch vụ của tất cả khách hàng theo một khoảng thời gian từ tháng A đến tháng B
        // elseif( $customer_Id == 0 && $monthFrom != 0 && $yearFrom != 0 && $monthTo != 0 && $yearTo != 0)
        // {
        //     return $this::statisticalByAllCustomerByMonthToMonth($type, $customer_Id, $monthFrom, $yearFrom, $monthTo, $yearTo);
        // }

        // else {
        //     return redirect()->back()->withErrors(['errors'=>'Một hoặc nhiều option bạn chọn chưa chính xác!!!']);
        // }

    }

    // thống kê phí dịch vụ của tất cả khách hàng theo một tháng đã chọn
    public static function statisticalByMonth($type, $month, $year)
    {
        $result = 1;
        $result_processed = 1;
        $customers = Customer::get();
        $calendar = SystemCalendar::find(1);
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
                        ->where('paid', 1)
                        ->get();
        return view('admin.paymentForServices.statisticalMonth', compact('result', 'result_processed', 'customers', 'bills', 'title', 'calendar'));
    } 
    
    // thống kê phí dịch vụ của một khách hàng theo một tháng đã chọn
    public static function statisticalByCustomerByMonth($type, $customer_Id, $month, $year)
    {
        $result = 1;
        $result_processed = 2;
        $calendar = SystemCalendar::find(1);
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
                        ->where('paid', 1)
                        ->get();
        return view('admin.paymentForServices.statisticalMonth', compact('result', 'result_processed', 'customer_result', 'bills', 'customers', 'title', 'calendar'));
    }

    // thống kê phí dịch vụ của một khách hàng theo một khoảng thời gian từ tháng A đến tháng B
    public static function statisticalByCustomerByMonthToMonth($type, $customer_Id, $monthFrom, $yearFrom, $monthTo, $yearTo)
    {
        $result = 1;
        $result_processed = 2;
        $customers = Customer::get();
        $customer_result = Customer::find($customer_Id);
        $calendar = SystemCalendar::find(1);
        if($type == 1){
            $title = 'Thống kê phí dịch vụ Điện sinh hoạt của '. $customer_result -> name .' từ tháng '.$monthFrom.' đến tháng '.$monthTo;
        }
        if($type == 2){
            $title = 'Thống kê phí dịch vụ Nước sinh hoạt của '. $customer_result -> name .' từ tháng '.$monthFrom.' đến tháng '.$monthTo;
        }
        if($type == 3){
            $title = 'Thống kê phí dịch vụ gửi xe của '. $customer_result -> name .' từ tháng '.$monthFrom.' đến tháng '.$monthTo;
        }
        $bills = Bill::where([
                                ['living_expenses_type_id', '=', $type],
                                ['customer_id', '=', $customer_Id],
                                ['payment_year', '>=' , $yearFrom],
                                ['payment_year', '<=' , $yearTo],
                                ['payment_month', '>=' , $monthFrom],
                                ['payment_month', '<=' , $monthTo],
                                ['paid', '=', 1]])
                                ->get();
        return view('admin.paymentForServices.statisticalMonthToMonth', compact('result', 'result_processed', 'customers', 'customer_result', 'bills', 'title', 'calendar'));
    }

    //thống kê tất cả khách hàng trong khoảng thời gian từ tháng A đến tháng B
    public static function statisticalByAllCustomerByMonthToMonth($type, $customer_Id, $monthFrom, $yearFrom, $monthTo, $yearTo)
    {
        $result = 1;
        $result_processed = 3;
        $customers = Customer::get();
        $calendar = SystemCalendar::find(1);
        if($type == 1){
            $title = 'Thống kê phí dịch vụ Điện sinh hoạt của các hộ từ tháng '.$monthFrom.' đến tháng '.$monthTo;
        }
        if($type == 2){
            $title = 'Thống kê phí dịch vụ Nước sinh hoạt của các hộ từ tháng '.$monthFrom.' đến tháng '.$monthTo;
        }
        if($type == 3){
            $title = 'Thống kê phí dịch vụ gửi xe của các hộ từ tháng '.$monthFrom.' đến tháng '.$monthTo;
        }
        $bills = Bill::where([
                                ['living_expenses_type_id', '=', $type],
                                ['payment_year', '>=' , $yearFrom],
                                ['payment_year', '<=' , $yearTo],
                                ['payment_month', '>=' , $monthFrom],
                                ['payment_month', '<=' , $monthTo],
                                ['paid', '=', 1]])
                                ->get();
        return view('admin.paymentForServices.statisticalMonthToMonth', compact('result', 'result_processed', 'customers', 'bills', 'title', 'calendar'));
    }

    public static function statisticalServicesByBlockFloorByMonth($typeServices = 0, $block = 0, $floor = 0, $year = 0, $month = 0)
    {
        // thống kê toàn bộ dịch vụ (hoặc 1 dịch vụ ) của tất cả các hộ của tất cả (hoặc một) block và tầng theo mốc thời gian
        // typeServices = 0: tất cả dịch vụ/ =1:điện/ =2:nước /=3:gửi xe /=4:quản lý vận hành
        
        $calendar = SystemCalendar::find(1);
        $customers = Customer::get();
        
        if($typeServices == 0) // tất cả dịch vụ
        {
                $result = 1;
                $bills = Bill::where('payment_year', $year)
                            ->where('payment_month', $month)
                            ->where('paid', 1)
                            ->get();
                if($block == 0 && $floor == 0)
                {
                    $result_processed = 1;
                    $title = 'Thống kê phí dịch vụ của các hộ trong tháng '.$month;
                    $apartmentAddress = ApartmentAddress::get();
                   
                }
                elseif($block != 0 && $floor == 0)
                {
                    $result_processed = 2;
                    $title = 'Thống kê phí dịch vụ của các hộ tại block '.$block.' trong tháng '.$month;
                    // lấy danh sách các chủ hộ tại block đó
                    $apartmentAddress = ApartmentAddress::where('block', $block)->get(); // lấy id của customer
                }
                elseif($block == 0 && $floor != 0)
                {
                    $result_processed = 2;
                    $title = 'Thống kê phí dịch vụ của các hộ tại tầng '. $floor.' trong tháng '.$month;
                    // lấy danh sách các chủ hộ tại floor đó
                    $apartmentAddress = ApartmentAddress::where('floor', $floor)->get(); // lấy id của customer
                }
                elseif($block != 0 && $floor != 0)
                {
                    $result_processed = 2;
                    $title = 'Thống kê phí dịch vụ của các hộ tại block '.$block. ' tầng '. $floor.' trong tháng '.$month;
                    // lấy danh sách các chủ hộ tại block và floor đó
                    $apartmentAddress = ApartmentAddress::where([['block', '=', $block], ['floor', '=', $floor]])->get(); // lấy id của customer
                }
                return view('admin.paymentForServices.statisticalMonth', compact('typeServices', 'result', 'result_processed', 'customers', 'bills', 'customers', 'title', 'calendar', 'apartmentAddress'));
                
        }
        if($typeServices > 0)
        {
            $result = 2;
            $result_processed = 3;
            if($typeServices == 1) // tiền điện
            {
                if($block == 0 && $floor == 0) // tiền điện của tất cả
                {
                    $result_processed = 3;
                    $apartmentAddress = ApartmentAddress::get();
                    $title = 'Thống kê phí dịch vụ Điện sinh hoạt của các hộ trong tháng '.$month;
                    
                }
                elseif($block != 0 && $floor == 0) // tiền điện của một block bất kỳ
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí dịch vụ Điện sinh hoạt của các hộ tại block '.$block.' trong tháng '.$month;
                    // lấy danh sách các chủ hộ tại block đó
                    $apartmentAddress = ApartmentAddress::where('block', $block)->get(); // lấy id của customer
                }
                elseif($block == 0 && $floor != 0) // tiền điện của một floor bất kỳ
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí dịch vụ Điện sinh hoạt của các hộ tại tầng '. $floor.' trong tháng '.$month;
                    // lấy danh sách các chủ hộ tại floor đó
                    $apartmentAddress = ApartmentAddress::where('floor', $floor)->get(); // lấy id của customer
                }
                elseif($block != 0 && $floor != 0) // tiền điện của một block và floor bất kỳ
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí dịch vụ Điện sinh hoạt của các hộ tại block '.$block. ' tầng '. $floor.' trong tháng '.$month;
                    // lấy danh sách các chủ hộ tại block và floor đó
                    $apartmentAddress = ApartmentAddress::where([['block', '=', $block], ['floor', '=', $floor]])->get(); // lấy id của customer
                }
                
            }
            if($typeServices == 2) // tiền nước
            {
                if($block == 0 && $floor == 0)
                {
                    $result_processed = 3;
                    $apartmentAddress = ApartmentAddress::get();
                    $title = 'Thống kê phí dịch vụ Nước sinh hoạt của các hộ trong tháng '.$month;
                }
                elseif($block != 0 && $floor == 0)
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí dịch vụ Nước sinh hoạt của các hộ tại block '.$block.' trong tháng '.$month;
                    // lấy danh sách các chủ hộ tại block đó
                    $apartmentAddress = ApartmentAddress::where('block', $block)->get(); // lấy id của customer
                }
                elseif($block == 0 && $floor != 0)
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí dịch vụ Nước sinh hoạt của các hộ tại tầng '. $floor.' trong tháng '.$month;
                    // lấy danh sách các chủ hộ tại floor đó
                    $apartmentAddress = ApartmentAddress::where('floor', $floor)->get(); // lấy id của customer
                }
                elseif($block != 0 && $floor != 0)
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí dịch vụ Nước sinh hoạt của các hộ tại block '.$block. ' tầng '. $floor.' trong tháng '.$month;
                    // lấy danh sách các chủ hộ tại block và floor đó
                    $apartmentAddress = ApartmentAddress::where([['block', '=', $block], ['floor', '=', $floor]])->get(); // lấy id của customer
                }
            }
            if($typeServices == 3) // tiền gửi xe
            {
                if($block == 0 && $floor == 0)
                {
                    $result_processed = 3;
                    $apartmentAddress = ApartmentAddress::get();
                    $title = 'Thống kê phí dịch vụ Gửi xe sinh hoạt của các hộ trong tháng '.$month;
                }
                elseif($block != 0 && $floor == 0)
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí dịch vụ Gửi xe sinh hoạt của các hộ tại block '.$block.' trong tháng '.$month;
                    // lấy danh sách các chủ hộ tại block đó
                    $apartmentAddress = ApartmentAddress::where('block', $block)->get(); // lấy id của customer
                }
                elseif($block == 0 && $floor != 0)
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí dịch vụ Gửi xe sinh hoạt của các hộ tại tầng '. $floor.' trong tháng '.$month;
                    // lấy danh sách các chủ hộ tại floor đó
                    $apartmentAddress = ApartmentAddress::where('floor', $floor)->get(); // lấy id của customer
                }
                elseif($block != 0 && $floor != 0)
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí dịch vụ Gửi xe sinh hoạt của các hộ tại block '.$block. ' tầng '. $floor.' trong tháng '.$month;
                    // lấy danh sách các chủ hộ tại block và floor đó
                    $apartmentAddress = ApartmentAddress::where([['block', '=', $block], ['floor', '=', $floor]])->get(); // lấy id của customer
                }
            }
            if($typeServices == 4) // phí quản lý vận hành
            {
                if($block == 0 && $floor == 0)
                {
                    $result_processed = 3;
                    $apartmentAddress = ApartmentAddress::get();
                    $title = 'Thống kê phí Quản lý vận hành của các hộ trong tháng '.$month;
                }
                elseif($block != 0 && $floor == 0)
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí Quản lý vận hành của các hộ tại block '.$block.' trong tháng '.$month;
                    // lấy danh sách các chủ hộ tại block đó
                    $apartmentAddress = ApartmentAddress::where('block', $block)->get(); // lấy id của customer
                }
                elseif($block == 0 && $floor != 0)
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí Quản lý vận hành của các hộ tại tầng '. $floor.' trong tháng '.$month;
                    // lấy danh sách các chủ hộ tại floor đó
                    $apartmentAddress = ApartmentAddress::where('floor', $floor)->get(); // lấy id của customer
                }
                elseif($block != 0 && $floor != 0)
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí Quản lý vận hành của các hộ tại block '.$block. ' tầng '. $floor.' trong tháng '.$month;
                    // lấy danh sách các chủ hộ tại block và floor đó
                    $apartmentAddress = ApartmentAddress::where([['block', '=', $block], ['floor', '=', $floor]])->get(); // lấy id của customer
                }
            }
            
            $bills = Bill::where('living_expenses_type_id', $typeServices)
                            ->where('payment_year', $year)
                            ->where('payment_month', $month)
                            ->where('paid', 1)
                            ->get();
        }
        
        return view('admin.paymentForServices.statisticalMonth', compact('typeServices', 'result', 'result_processed', 'customers', 'bills', 'customers', 'title', 'calendar', 'apartmentAddress'));
    }

    public static function statisticalAllServicesByBlockFloorByMonth()
    {
        // thống kê toàn bộ dịch vụ của khách hàng theo block theo mốc thời gian
    }

    public static function statisticalAllServicesByAllCustomerByMonthToMonth()
    {
        // thống kê toàn bộ dịch vụ của tất cả khách hàng theo khoảng thời gian

    }

    public static function statisticalAllServicesByBlockFloorByMonthToMonth()
    {
        // thống kê toàn bộ dịch vụ của khách hàng theo block theo khoảng thời gian
    }
}
