<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ApartmentAddress;
use App\Models\FamilyMember;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Role;
use App\User;
use App\Models\VehicleCuctomer;
use App\Models\Notification;
use App\Models\Vehicle;
use App\Models\SystemCalendar;
use Illuminate\Support\Facades\Hash;
use App\Models\LicensePlates;

class Customer extends Model
{
    public $table = 'customers';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'date_of_birth',
        'gender',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class)->withPivot([
            'amount',
            'customer_id',
            'vehicle_id',
            'year_use',
            'month_start_use',
            'using'
        ]);
    }

    public function apartmentAddress()
    {
        return $this->hasOne(ApartmentAddress::class, 'customer_id', 'id');
    }

    public function familyMembers()
    {
        return $this->hasMany(FamilyMember::class, 'customer_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'customer_id', 'id');
    }

    public function notifications() // tên table
    {
        return $this->belongsToMany(Notification::class)->withPivot([
            'bill_id',
            'customer_id',
            'notification_id',
        ]);
    }

    // fuction kiểm tra apartment khi thêm customer
    public static  function checkApartment($block, $floor, $apartment){
        // apartment đã có người thuê -> return false, else return true
        $apartment = ApartmentAddress::select('*')
        ->where('block', $block)
        ->where('floor', $floor)
        ->where('apartment', $apartment)
        ->where('hired', 1)
        ->get(); 
        if(count($apartment)>0)
            {
                return false;
            }
        return true;
    }

    public static function utf8convert($str) {
        if(!$str) return false;
        $utf8 = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd'=>'đ|Đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',);
        foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);
        return $str;
    }

    public static function createCustomer(Request $request){
            // phần sinh password tự động 
            $name = strtolower(Customer::utf8convert($request -> name));
            $passForName = '';
            $lastName = '';
            $count = str_word_count($name);
            $pieces = explode(" ", $name);
            // lấy ký tự cuối - tên
            for($i = $count-1; $i > 1; $i--){
                $lastName = $pieces[$i];
                break;
            }
            // lấy các ký tự đầu tiên của họ và tên lót
            for($i = 0; $i < $count-1; $i++){
                $passForName = $passForName.$pieces[$i][0]; // lấy ký tự đầu tiên của từ thứ i
            }
            $passForName = $lastName.$passForName;
            
            $customer = new Customer();
            $customer -> name = $request -> name;
            $customer -> email = $request -> email;
            $customer -> password = $passForName;
            $customer -> phone = $request -> phone;
            $customer -> date_of_birth = $request -> date_of_birth;
            $customer -> gender = $request -> gender;
            $customer -> save();

            // cấp quyền cho customer
            $role_customer = Role::where('name', 'customer')->first();
            $customer_roled = new User();
            $customer_roled->id = $customer -> id;
            $customer_roled->name = $customer -> name;
            $customer_roled->email = $customer -> email;
            $customer_roled->password = Hash::make($customer -> password);
            $customer_roled->save();
            $customer_roled->roles()->attach($role_customer);

            // add apartment
            $block = $request -> selectBlock;
            $floor = $request -> selectFloor;
            $acreage = $request ->acreage;
            $apartmentInput = $request -> selectApartment;

            $apartment = new ApartmentAddress();
            $apartment -> customer_id = $customer->id;
            $apartment -> block = $block;
            $apartment -> floor = $floor;
            $apartment -> apartment = $apartmentInput; // để tên giống sẽ bị báo lỗi đệ quy
            $apartment -> acreage = $acreage;

            $apartment -> hired = 1;
            $apartment -> save();

            // add vehicle
            Customer::addVehicle($request, $customer);
    }

    public static function addVehicle(Request $request, Customer $customer){
        $calendar = SystemCalendar::find(1); 
            $month = $calendar -> month;
            $year = $calendar -> year;
            //$year = $calendar -> year;
            // Các loại phương tiện
            $typeVehicle_Car = Vehicle::where('id', 1)->first();
            $typeVehicle_Moto = Vehicle::where('id', 2)->first();
            $typeVehicle_Bike = Vehicle::where('id', 3)->first();
            
            // if customer have car
            if($request -> car > 0){
                $customer->vehicles()->attach($typeVehicle_Car, [ 'amount' => $request -> car,
                                                'month_start_use' => $month, 'year_use' => $year, 'using' => 1
                                                   ]);  
                // lấy record vừa tạo
                $customer_id = VehicleCuctomer::orderBy('created_at', 'desc')->first()->customer_id;
                LicensePlates::carLicensePlates($request, $customer_id);
            }
            // if customer have moto
            if($request -> moto > 0){
                $customer->vehicles()->attach($typeVehicle_Moto, [ 'amount' => $request -> moto,
                                                    'month_start_use' => $month, 'year_use' => $year, 'using' => 1
                                                    ]);
                $customer_id = VehicleCuctomer::orderBy('created_at', 'desc')->first()->customer_id;
                LicensePlates::motoLicensePlates($request, $customer_id);
            }
            // if customer have bike
            if($request -> bike > 0){
                $customer->vehicles()->attach($typeVehicle_Bike, [ 'amount' => $request -> bike,
                                                    'month_start_use' => $month, 'year_use' => $year, 'using' => 1
                                                    ]);
            }
    }
}
