@extends('admin.home')

@section('content')
<div class="create-customer">
    <h3 style="text-align: center">Cập nhật thông tin Chủ hộ</h3>
    <br><br>
    <form method="post" action="{{ route('admin.customers.update', $customer->id)}}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Tên Chủ hộ:</label>
                <input type="text" class="form-control" name="name" value="{{ $customer->name }}">
                </div>
                <div class="form-group">
                    <label for="">Ngày sinh:</label>
                    <input type="date" class="form-control" name="date_of_birth" value="{{ $customer->name }}">
                </div>
                <div class="form-group">
                <label for="">Giới tính:</label>
                <select name="gender" id="">
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>
                </select>
                </div>
                <div class="form-group">
                    <label for="email">SĐT:</label>
                    <input type="text" class="form-control" placeholder="Nhập SĐT" name="phone" value="{{ $customer->phone }}">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" placeholder="Nhập email" name="email" value="{{ $customer->email }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="vehicle-status">
                    <div class="form-group vehicle">
                        <label for="pwd">Số lượng phương tiện và tình trạng sử dụng:</label>
                        @foreach($vehicles as $vehicle)
                            <ul>
                                <li>
                                    @if($vehicle -> vehicle_id == 1)
                                        <p>Xe ô tô : <input min="0" style="margin-left: 30px" type="number" name="car_amount" value="{{ $vehicle->amount }}">
                                        <select name="status_car" id="">
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
                                <li>
                                    @if($vehicle -> vehicle_id == 2)
                                        <p>Xe mô tô : <input  min="0" style="margin-left: 15px" type="number" name="moto_amount" value="{{ $vehicle->amount }}">
                                        <select name="status_moto" id="">
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
                    <div class="add-vehicle">
                        <p>Thêm một loại phương tiện khác</p>
                        <p>
                            <select name="add_new_vehicle_type" id="">
                                <option selected value="0">Chọn loại phương tiện</option>
                                @foreach ($vehiclesTypes as $vehiclesType)
                                    <option
                                    @foreach ($vehicles as $vehicle)
                                        @if($vehiclesType->id == $vehicle->vehicle_id)
                                            disabled
                                        @endif
                                    @endforeach
                                    value="{{$vehiclesType->id}}">{{$vehiclesType->name}}</option>
                                @endforeach
                            </select>
                            <p>Số lượng
                            <input style="width: 190px;" type="number" min="0" class="form-control" name="add_new_vehicle_amount" value="{{ $customer->name }}">
                            </p>   
                        </p>
                    </div>
                </div>
                {{-- <div class="form-group address">
                    <label for="pwd">Địa chỉ căn hộ:</label>
                    <ul>
                        <li><label for="pwd">Block:</label>
                            <select name="selectBlock" id="">
                                <option selected value="{{ $customer->apartmentAddress['block'] }}">{{ $customer->apartmentAddress['block'] }}</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </li>
                        <li><label for="pwd">Tầng:</label>
                            <select name="selectFloor" id="">
                                <option selected value="{{ $customer->apartmentAddress['floor'] }}">{{ $customer->apartmentAddress['floor'] }}</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </li>
                        <li><label for="pwd">Nhà:</label>
                            <select name="selectApartment" id="">
                                <option selected value="{{ $customer->apartmentAddress['apartment'] }}">{{ $customer->apartmentAddress['apartment'] }}</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </li>
                    </ul>
                </div> --}}
            </div>
        </div>
        <br><br>
        <button style="position: relative; left: 45.8%;" type="submit" class="btn btn-primary">Cập nhật</button>
      </form>
      <br>
      <a style="position: relative; left: 46%;" href="{{ url()->previous() }}" class="btn btn-primary">Quay lại</a>
</div>
<style>
    .vehicle{
        width: 500px;
        left: 0%;
    }
    .vehicle li{
        list-style: none;
        margin-bottom: 20px;
    }
    .vehicle select{
        width: 170px;
        height: 35px;
        border-radius: 4px;
        float: right;
    }
    .add-vehicle select{
        width: 190px;
        height: 35px;
        border-radius: 4px;
        }
    .vehicle input{
        border-radius: 4px;
        border: 1px solid gray;
        height: 35px;
        padding-left: 20px;
    }
    .create-customer{
        position: relative;
        left: 0%;
        top: 0%;
        width: 100%;
        height: 1000px;
        border: 1px solid black;
        border-radius: 5px;
        padding: 30px;
    }

    .address li{
        list-style: none;
        float: left;
        margin-right: 30px;
    }
    select{
        width: 70px;
        height: 35px;
        border-radius: 4px;
    }
    
</style>
@endsection