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

    public function statistical(Request $request, $byMonthOrByMonthToMonth)
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

        if($byMonthOrByMonthToMonth == 1)
        {
            return $this::statisticalServicesByBlockFloorByMonth($typeServices, $block, $floor, $year, $month);
        }
        elseif($byMonthOrByMonthToMonth == 2) 
            return $this::statisticalServicesByBlockFloorByMonthToMonth($typeServices, $block, $floor, $monthFrom, $yearFrom, $monthTo, $yearTo);
        
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

    public static function statisticalServicesByBlockFloorByMonthToMonth($typeServices = 0, $block = 0, $floor = 0, $monthFrom, $yearFrom = 0, $monthTo = 0, $yearTo = 0)
    {
        // thống kê toàn bộ dịch vụ của khách hàng theo block floor theo khoảng thời gian
        // typeServices = 0: tất cả dịch vụ/ =1:điện/ =2:nước /=3:gửi xe /=4:quản lý vận hành
        
        $calendar = SystemCalendar::find(1);
        $customers = Customer::get();
        
        if($typeServices == 0) // tất cả dịch vụ
        {
                $result = 1;
                if($monthFrom <= $monthTo && $yearFrom == $yearTo)
                {
                    $bills = Bill::where([
                        ['payment_year', '>=' , $yearFrom],
                        ['payment_year', '<=' , $yearTo],
                        ['payment_month', '>=' , $monthFrom],
                        ['payment_month', '<=' , $monthTo],
                        ['paid', '=', 1]])
                        ->get();
                }
                elseif($monthFrom >= $monthTo && $yearFrom < $yearTo)
                {
                    $bills = Bill::where([
                        ['payment_year', '>=' , $yearFrom],
                        ['payment_month', '>=' , $monthFrom],
                        ['paid', '=', 1]])
                        ->orWhere([
                        ['payment_year', '<=' , $yearTo],
                        ['payment_month', '<=' , $monthTo],
                        ])
                        ->get();
                }
                else return redirect()->back()->withErrors(['errors'=>'Khoảng thời gian bạn chọn chưa chính xác!!!']);
                
                if($block == 0 && $floor == 0)
                {
                    $result_processed = 1;
                    $title = 'Thống kê phí dịch vụ của các hộ từ tháng '.$monthFrom.' năm '.$yearFrom.' đến tháng '.$monthTo.' năm '.$yearTo;
                    $apartmentAddress = ApartmentAddress::get();
                   
                }
                elseif($block != 0 && $floor == 0)
                {
                    $result_processed = 2;
                    $title = 'Thống kê phí dịch vụ của các hộ tại block '.$block.' từ tháng '.$monthFrom.' năm '.$yearFrom.' đến tháng '.$monthTo.' năm '.$yearTo;
                    // lấy danh sách các chủ hộ tại block đó
                    $apartmentAddress = ApartmentAddress::where('block', $block)->get(); // lấy id của customer
                }
                elseif($block == 0 && $floor != 0)
                {
                    $result_processed = 2;
                    $title = 'Thống kê phí dịch vụ của các hộ tại tầng '. $floor.' từ tháng '.$monthFrom.' năm '.$yearFrom.' đến tháng '.$monthTo.' năm '.$yearTo;
                    // lấy danh sách các chủ hộ tại floor đó
                    $apartmentAddress = ApartmentAddress::where('floor', $floor)->get(); // lấy id của customer
                }
                elseif($block != 0 && $floor != 0)
                {
                    $result_processed = 2;
                    $title = 'Thống kê phí dịch vụ của các hộ tại block '.$block. ' tầng '. $floor.' từ tháng '.$monthFrom.' năm '.$yearFrom.' đến tháng '.$monthTo.' năm '.$yearTo;
                    // lấy danh sách các chủ hộ tại block và floor đó
                    $apartmentAddress = ApartmentAddress::where([['block', '=', $block], ['floor', '=', $floor]])->get(); // lấy id của customer
                }
                
                return view('admin.paymentForServices.statisticalMonthToMonth', compact('typeServices', 'result', 'result_processed', 'customers', 'bills', 'customers', 'title', 'calendar', 'apartmentAddress'));
                
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
                    $title = 'Thống kê phí dịch vụ Điện sinh hoạt của các hộ từ tháng '.$monthFrom.' năm '.$yearFrom.' đến tháng '.$monthTo.' năm '.$yearTo;
                    
                }
                elseif($block != 0 && $floor == 0) // tiền điện của một block bất kỳ
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí dịch vụ Điện sinh hoạt của các hộ tại block '.$block.' từ tháng '.$monthFrom.' năm '.$yearFrom.' đến tháng '.$monthTo.' năm '.$yearTo;
                    // lấy danh sách các chủ hộ tại block đó
                    $apartmentAddress = ApartmentAddress::where('block', $block)->get(); // lấy id của customer
                }
                elseif($block == 0 && $floor != 0) // tiền điện của một floor bất kỳ
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí dịch vụ Điện sinh hoạt của các hộ tại tầng '. $floor.' từ tháng '.$monthFrom.' năm '.$yearFrom.' đến tháng '.$monthTo.' năm '.$yearTo;
                    // lấy danh sách các chủ hộ tại floor đó
                    $apartmentAddress = ApartmentAddress::where('floor', $floor)->get(); // lấy id của customer
                }
                elseif($block != 0 && $floor != 0) // tiền điện của một block và floor bất kỳ
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí dịch vụ Điện sinh hoạt của các hộ tại block '.$block. ' tầng '. $floor.' từ tháng '.$monthFrom.' năm '.$yearFrom.' đến tháng '.$monthTo.' năm '.$yearTo;
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
                    $title = 'Thống kê phí dịch vụ Nước sinh hoạt của các hộ từ tháng '.$monthFrom.' năm '.$yearFrom.' đến tháng '.$monthTo.' năm '.$yearTo;
                }
                elseif($block != 0 && $floor == 0)
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí dịch vụ Nước sinh hoạt của các hộ tại block '.$block.' từ tháng '.$monthFrom.' năm '.$yearFrom.' đến tháng '.$monthTo.' năm '.$yearTo;
                    // lấy danh sách các chủ hộ tại block đó
                    $apartmentAddress = ApartmentAddress::where('block', $block)->get(); // lấy id của customer
                }
                elseif($block == 0 && $floor != 0)
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí dịch vụ Nước sinh hoạt của các hộ tại tầng '. $floor.' từ tháng '.$monthFrom.' năm '.$yearFrom.' đến tháng '.$monthTo.' năm '.$yearTo;
                    // lấy danh sách các chủ hộ tại floor đó
                    $apartmentAddress = ApartmentAddress::where('floor', $floor)->get(); // lấy id của customer
                }
                elseif($block != 0 && $floor != 0)
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí dịch vụ Nước sinh hoạt của các hộ tại block '.$block. ' tầng '. $floor.' từ tháng '.$monthFrom.' năm '.$yearFrom.' đến tháng '.$monthTo.' năm '.$yearTo;
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
                    $title = 'Thống kê phí dịch vụ Gửi xe sinh hoạt của các hộ từ tháng '.$monthFrom.' năm '.$yearFrom.' đến tháng '.$monthTo.' năm '.$yearTo;
                }
                elseif($block != 0 && $floor == 0)
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí dịch vụ Gửi xe sinh hoạt của các hộ tại block '.$block.' từ tháng '.$monthFrom.' năm '.$yearFrom.' đến tháng '.$monthTo.' năm '.$yearTo;
                    // lấy danh sách các chủ hộ tại block đó
                    $apartmentAddress = ApartmentAddress::where('block', $block)->get(); // lấy id của customer
                }
                elseif($block == 0 && $floor != 0)
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí dịch vụ Gửi xe sinh hoạt của các hộ tại tầng '. $floor.' từ tháng '.$monthFrom.' năm '.$yearFrom.' đến tháng '.$monthTo.' năm '.$yearTo;
                    // lấy danh sách các chủ hộ tại floor đó
                    $apartmentAddress = ApartmentAddress::where('floor', $floor)->get(); // lấy id của customer
                }
                elseif($block != 0 && $floor != 0)
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí dịch vụ Gửi xe sinh hoạt của các hộ tại block '.$block. ' tầng '. $floor.' từ tháng '.$monthFrom.' năm '.$yearFrom.' đến tháng '.$monthTo.' năm '.$yearTo;
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
                    $title = 'Thống kê phí Quản lý vận hành của các hộ từ tháng '.$monthFrom.' năm '.$yearFrom.' đến tháng '.$monthTo.' năm '.$yearTo;
                }
                elseif($block != 0 && $floor == 0)
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí Quản lý vận hành của các hộ tại block '.$block.' từ tháng '.$monthFrom.' năm '.$yearFrom.' đến tháng '.$monthTo.' năm '.$yearTo;
                    // lấy danh sách các chủ hộ tại block đó
                    $apartmentAddress = ApartmentAddress::where('block', $block)->get(); // lấy id của customer
                }
                elseif($block == 0 && $floor != 0)
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí Quản lý vận hành của các hộ tại tầng '. $floor.' từ tháng '.$monthFrom.' năm '.$yearFrom.' đến tháng '.$monthTo.' năm '.$yearTo;
                    // lấy danh sách các chủ hộ tại floor đó
                    $apartmentAddress = ApartmentAddress::where('floor', $floor)->get(); // lấy id của customer
                }
                elseif($block != 0 && $floor != 0)
                {
                    $result_processed = 4;
                    $title = 'Thống kê phí Quản lý vận hành của các hộ tại block '.$block. ' tầng '. $floor.' từ tháng '.$monthFrom.' năm '.$yearFrom.' đến tháng '.$monthTo.' năm '.$yearTo;
                    // lấy danh sách các chủ hộ tại block và floor đó
                    $apartmentAddress = ApartmentAddress::where([['block', '=', $block], ['floor', '=', $floor]])->get(); // lấy id của customer
                }
            }

            if($monthFrom <= $monthTo && $yearFrom == $yearTo)
                {
                    $bills = Bill::where([
                        ['living_expenses_type_id', '=', $typeServices],
                        ['payment_year', '>=' , $yearFrom],
                        ['payment_year', '<=' , $yearTo],
                        ['payment_month', '>=' , $monthFrom],
                        ['payment_month', '<=' , $monthTo],
                        ['paid', '=', 1]])
                        ->get();
                }
                elseif($monthFrom >= $monthTo && $yearFrom < $yearTo)
                {
                    $bills = Bill::where([
                        ['living_expenses_type_id', '=', $typeServices],
                        ['payment_year', '>=' , $yearFrom],
                        ['payment_month', '>=' , $monthFrom],
                        ['paid', '=', 1]])
                        ->orWhere([
                        ['payment_year', '<=' , $yearTo],
                        ['payment_month', '<=' , $monthTo],
                        ])
                        ->get();
                }
                else return redirect()->back()->withErrors(['errors'=>'Khoảng thời gian bạn chọn chưa chính xác!!!']);
        }
        return view('admin.paymentForServices.statisticalMonthToMonth', compact('typeServices', 'result', 'result_processed', 'customers', 'bills', 'customers', 'title', 'calendar', 'apartmentAddress'));
    }

    
}
