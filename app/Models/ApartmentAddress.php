<?php

namespace App\Models;
use App\Customer;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\RoleUser;

class ApartmentAddress extends Model
{
    protected $table = 'apartment_addresses';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'block', 
        'floor', 
        'apartment', 
        'acreage',
        'hired'
    ];

    public function customers() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    protected function addForUserAndCreateUser(Request $request, UserRequest $uRequest) {
        $block = $request -> selectBlock;
        $floor = $request -> selectFloor;
        $apartmentInput = $request -> selectApartment;
        // trường hợp đã có id căn hộ đó rồi (thông tin căn hộ đã dc tạo) nhưng chưa có ai thuê => dc phép cấp căn hộ
        $apartment_1 = ApartmentAddress::select('*')->where('block', $block)
                                                ->where('floor', $floor)
                                                ->where('apartment', $apartmentInput)
                                                ->where('hired', 0)
                                                ->where('user_id', null)
                                                ->get(); 
        // trường hợp đã có id căn hộ đó rồi (thông tin căn hộ đã dc tạo) nhưng đã có người thuê => ko dc phép cấp căn hộ
        $apartment_2 = ApartmentAddress::select('*')->where('block', $block)
                                                ->where('floor', $floor)
                                                ->where('apartment', $apartmentInput)
                                                ->where('hired', 1)
                                                ->get();
        // trường hợp chưa có id căn hộ đó (thông tin căn hộ chưa dc tạo) => dc phép tạo căn hộ mới

        foreach($apartment_1 as $apart_1){
            //TH1
            if($apart_1['id'] != null){
                $apartmentConcrete = ApartmentAddress::find($apart_1['id']);
                User::addUser($uRequest,$request);
                // lấy user dc tạo sau cùng để gán id cho $apart_1 -> user_id
                $userRecently = User::select('*')->orderBy('created_at', 'desc')
                                                    ->limit(1)->get()->toArray();
                foreach($userRecently as $user){
                    $apartmentConcrete -> user_id = $user['id'];
                    $apartmentConcrete -> hired = 1;
                    $apartmentConcrete -> save();

                    // tạo role cho user
                    $role_user = new RoleUser();
                    $role_user -> role_id = 1;
                    $role_user -> user_id = $user['id'];
                    $role_user -> save();
                    return;
                }
            } 
        }
        foreach($apartment_2 as $apart_2){
            //TH2
            if($apart_2['id'] != null){
                return 1;
            }
        }
        // TH3
        if($apartment_1->isEmpty() && $apartment_2->isEmpty())
        { // hàm isEmpty chỉ áp dụng dc với collection
            User::addUser($uRequest,$request);
            $apartment = new ApartmentAddress();
            $apartment -> block = $block;
            $apartment -> floor = $floor;
            $apartment -> apartment = $apartmentInput; // để tên giống sẽ bị báo lỗi đệ quy
            $apartment -> hired = 1;
            $userRecently = User::select('*')->orderBy('created_at', 'desc')
                                                ->limit(1)->get()->toArray();
            foreach($userRecently as $user){
                $apartment -> user_id = $user['id'];
                $apartment -> save();

                // tạo role cho user
                $role_user = new RoleUser();
                $role_user -> role_id = 1;
                $role_user -> user_id = $user['id'];
                $role_user -> save();
                return;
            }
        }

    }
}
