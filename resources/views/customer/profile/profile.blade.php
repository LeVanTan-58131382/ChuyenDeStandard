
@extends('customer.home')

@section('content')
<div class="detail-customer wow fadeInRight">
<div class="bang">
    <h3>Hồ sơ Chủ hộ</h3>
    <br>
    <p><b>Mã Chủ hộ:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $customer -> id}}</p>
    <p><b>Họ tên:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $customer -> name}}</p>
    <p><b>Email:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $customer -> email}}</p>
    <p><b>Ngày sinh:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> {{ $customer -> date_of_birth}}</p>
    <p><b>Giới tính:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
        @if($customer -> gender == true)
        Nam
        @else
        Nữ
        @endif
    </p>
    <p><b>Địa chỉ:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> Block: {{ $customer->apartmentAddress['block'] }} 
        Tầng: {{ $customer->apartmentAddress['floor']}} 
        Nhà: {{ $customer->apartmentAddress['apartment']}}
    </p>
    <p><b>Số điện thoại:&nbsp;&nbsp;&nbsp;&nbsp;</b> {{ $customer -> phone}}</p>
    {{-- <h3>Chi tiết Chủ hộ</h3>
    <br>
    <p><b>Mã Chủ hộ:</b> {{ $customer -> id}}</p>
    <p><b>Họ tên:</b> {{ $customer -> name}}</p>
    <p><b>Email:</b> {{ $customer -> email}}</p>
    <p><b>Ngày sinh:</b> {{ $customer -> date_of_birth}}</p>
    <p><b>Giới tính:</b>
        @if($customer -> gender == true)
        Nam
        @else
        Nữ
        @endif
    </p>
    <p><b>Địa chỉ:</b> Block: {{ $customer->apartmentAddress['block'] }} 
        Tầng: {{ $customer->apartmentAddress['floor']}} 
        Nhà: {{ $customer->apartmentAddress['apartment']}}
    </p>
    <p><b>Số điện thoại:</b> {{ $customer -> phone}}</p> --}}
</div>
    <div class="form-group vehicle">
        <h3>Phương tiện sử dụng</h3>
        <label for="pwd">Số lượng phương tiện và tình trạng sử dụng:</label>
        @foreach($vehicles as $vehicle)
            <ul>
                <li>
                    @if($vehicle -> vehicle_id == 1)
                        <p>Xe ô tô : {{ $vehicle->amount }}
                            @if($vehicle -> using == 1)
                            Đang sử dụng
                            @elseif($vehicle -> using == 0)
                            Không sử dụng nữa
                            @endif
                        </p>
                        <p>
                            Biển Kiểm soát: <b>79F 88888</b>
                        </p>
                    @endif
                </li>
                <li>
                    @if($vehicle -> vehicle_id == 2)
                        <p>Xe mô tô : {{ $vehicle->amount }}
                            @if($vehicle -> using == 1)
                            Đang sử dụng
                            @elseif($vehicle -> using == 0)
                            Không sử dụng nữa
                            @endif
                        </p>
                        <p>
                            Biển kiểm soát: <b>79A 55555</b>, <b>79A1 99999</b> 
                        </p>
                    @endif
                </li> 
                <li>
                    @if($vehicle -> vehicle_id == 3)
                        <p>Xe đạp : <input  min="0" style="margin-left: 31px" type="number" name="bike_amount" value="{{ $vehicle->amount }}">
                        <select name="status_bike" id="">
                            @if($vehicle -> using == 1)
                            <option selected value="2">Đang sử dụng</option>
                            <option value="1">Không sử dụng nữa</option>
                            @elseif($vehicle -> using == 0)
                            <option selected value="1">Không sử dụng nữa</option>
                            <option value="2">Đang sử dụng</option>
                            @endif
                        </select></p>
                    @endif
                </li>
            </ul>
        @endforeach
    </div>
    <div class="allmember">
    @if(count($customer->familyMembers) > 0)
    <h3>Thành viên gia đình</h3>
    @endif
    @foreach ($customer->familyMembers as $member)
    <div class="member">
        <p><b>Họ tên:</b> {{ $member -> name}}</p>
        <p><b>Email:</b> {{ $member -> email}}</p>
        <p><b>Ngày sinh:</b> {{ $member -> date_of_birth}}</p>
        <p><b>Giới tính:</b>
            @if($member -> gender == true)
            Nam
            @else
            Nữ
            @endif
        </p>
    </div>
    @endforeach
</div>
</div>
<style>
    .detail-customer{
        position: relative;
        left: 5%;
        top: 0%;
        width: 95%;
        height: auto;
        /* background-color: -webkit-linear-gradient(top right, #00d8c2, #0068b7);
        background-image: -webkit-linear-gradient(right top, rgb(0, 216, 194), rgb(0, 104, 183)); */
        background-color: #007bff;
        color: #343a40;
        transition: 0.5s;
        border: 1px solid white;
        border-radius: 5px;
        padding: 30px;
    }
    h3{
        text-align: center;
    }
    .member{
        position: relative;
        background-color: lightskyblue;
        border: 1px solid #343a40;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
    }
    .bang, .allmember, .vehicle{
        position: relative;
        background-color: whitesmoke;
        border: 1px solid gray;
        border-radius: 9px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    
    .vehicle li{
        list-style: none;
        margin-bottom: 20px;
    }
</style>
@endsection