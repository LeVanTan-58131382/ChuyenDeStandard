@extends('admin.home')

@section('content')
<div class="create-customer">
    <h3 style="text-align: center">Tạo mới Chủ hộ</h3>
    <br><br>
    <form method="post" action="/customers/{{ $customer->id}}">
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
                {{-- <div class="form-group">
                    <label for="pwd">Mật khẩu: Tự động</label>
                    {{-- <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="password">
                </div> --}}
                  <div class="form-group vehicle">
                      <label for="pwd">Phương tiện:</label>
                      <ul>
                          <li>
                              <p>Xe ô tô : <input min="0" style="margin-left: 30px" type="number" name="car" value="{{ $customer->name }}"></p>
                          </li>
                          <li>
                              <p>Xe mô tô : <input min="0" style="margin-left: 15px" type="number" name="moto" value="{{ $customer->name }}"></p>
                          </li>
                          <li>
                              <p>Xe đạp : <input min="0" style="margin-left: 31px" type="number" name="bike" value="{{ $customer->name }}"></p>
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
        height: 30px;
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