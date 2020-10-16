@extends('admin.home')

@section('content')
<script type="text/javascript">
    $(document).ready(function(){
        // var a = '{{$calendar->month}}'; cách chèn code php vào javascript
        // console.log(a);
        i = 1;
        $("#btn_insert").click(function(){
            var max = document.getElementById("carSoLuong").value;
            if(max > 0)
            {
                $("#insert").append("<input min='0' required style='padding-left: 10px; margin-top: 5px; margin-left: 93px;' type='text' name='license_plates_car_"+i+"' placeholder='Nhập BKS xe thứ "+i+" '>");
                if(i == max)
                {
                    document.getElementById("btn_insert").disabled = true;
                }
                i++;
                }
        });

        j = 1;
        $("#btn_insert_2").click(function(){
            var max_2 = document.getElementById("motoSoLuong").value;
            if(max_2 > 0)
            {
                $("#insert_2").append("<input min='0' required style='padding-left: 10px; margin-top: 5px; margin-left: 93px;' type='text' name='license_plates_moto_"+j+"' placeholder='Nhập BKS xe thứ "+j+" '>");
                if(j == max_2)
                {
                    document.getElementById("btn_insert_2").disabled = true;
                }
                j++;
                }
        });
	});
</script>
<div class="create-customer">
    <h3 style="text-align: center">Tạo mới Chủ hộ</h3>
    <br><br>
    <form method="post" action="{{ route('admin.customers.store')}}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Tên Chủ hộ:</label>
                    <input required type="text" class="form-control" placeholder="Nhập tên chủ hộ..." name="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="">Ngày sinh:</label>
                    <input required type="date" class="form-control" name="date_of_birth">
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
                    <input required type="text" class="form-control" placeholder="Nhập SĐT" name="phone" value="{{ old('phone') }}">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input required type="email" class="form-control" placeholder="Nhập email" name="email" value="{{ old('email') }}">
                </div>
            </div>
            <div class="col-md-6">
                  <div class="form-group vehicle">
                      <label for="pwd">Phương tiện:</label>
                      <ul>
                            <li>
                                <p>Xe ô tô : <input id="carSoLuong" min="0" max="{{$setting_indexs->highest_number_of_cars}}" style="padding-left: 10px; margin-left: 30px; width: 200px" type="number" name="car" placeholder="Số lượng"></p>
                            </li>
                            <li>
                                <p>
                                        <input id="btn_insert" name="btn_insert" type="button"
                                        style="width: 83px; padding: 5px;
                                        " class="btn btn-primary" value="Thêm BKS"> 
                                </p>
                                <p id="insert"></p>
                            </li>
                            <li>
                                <p>Xe mô tô : <input id="motoSoLuong" min="0" max="{{$setting_indexs->highest_number_of_motos}}" style=" padding-left: 10px;margin-left: 15px; width: 200px" type="number" name="moto" placeholder="Số lượng"></p>
                            </li>
                            <li>
                                <p>
                                        <input id="btn_insert_2" name="btn_insert" type="button"
                                        style="width: 83px; padding: 5px;
                                        " class="btn btn-primary" value="Thêm BKS">
                                </p>
                                <p id="insert_2"></p>
                            </li>
                            <li>
                                <p>Xe đạp : <input min="0" max="{{$setting_indexs->highest_number_of_bikes}}" style="padding-left: 10px; margin-left: 31px; width: 200px" type="number" name="bike" placeholder="Số lượng"></p>
                            </li>
                      </ul>
                </div>
                <div class="form-group address">
                    <label for="pwd">Địa chỉ căn hộ:</label>
                    <ul>
                        <li><label for="pwd">Block:</label>
                            <select name="selectBlock" id="">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </li>
                        <li><label for="pwd">Tầng:</label>
                            <select name="selectFloor" id="">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </li>
                        <li><label for="pwd">Nhà:</label>
                            <select name="selectApartment" id="">
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
                </div>
                <br><br>
                <div class="dientich">
                    <div class="form-group">
                        <label for="">Diện tích căn hộ:</label>
                        <select name="acreage" id="">
                            <option value="80">80</option>
                            <option value="85">85</option>
                            <option value="90">90</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <button type="submit" class="btn btn-primary">Tạo mới</button>
      </form>
</div>
<style>
    .vehicle li{
        list-style: none;
    }

    .vehicle input{
        border-radius: 4px;
        border: 1px solid gray;
        height: 35px;
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