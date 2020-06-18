<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\SystemCalendar;

use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function getSetting(Request $request){ 
        $request->user()->authorizeRoles(['admin']);
        $calendar = SystemCalendar::find(1);
        $setting_indexs = Setting::find(1);
        return view('admin.setting', compact('calendar', 'setting_indexs'));
    }

    public function postSetting(Request $request){
        $calendar = SystemCalendar::find(1);
        $setting_indexs = Setting::find(1);

        $month = $request -> month;
        $year = $request -> year;

        $max_car = $request -> max_car;
        $max_moto = $request -> max_moto;
        $max_bike = $request -> max_bike;

        $calendar->month = $month;
        $calendar->year = $year;
        $calendar->save();

        $setting_indexs->highest_number_of_cars = $max_car;
        $setting_indexs->highest_number_of_motos = $max_moto;
        $setting_indexs->highest_number_of_bikes = $max_bike;
        $setting_indexs->save();

        return view('admin.setting', compact('calendar', 'setting_indexs'))->with('success', 'Cài đặt thành công!');
    }

}
