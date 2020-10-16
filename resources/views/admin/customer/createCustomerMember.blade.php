@extends('admin.home')

@section('content')
<div class="create-customer">
    <h3 style="text-align: center">Thêm thành viên gia đình</h3>
    <br><br>
    <form method="post" action="{{ route('admin.family-member-save', $customerId)}}">
        @csrf
        <div class="row">
            <input type="hidden" value="{{$customerId}}" name="customer_id">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="">Tên thành viên gia đình:</label>
                    <input required type="text" class="form-control" placeholder="Nhập tên..." name="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="">Loại thành viên gia đình:</label>
                    <select name="thanhvien" id="">
                        <option value="1">Vợ</option>
                        <option value="2">Chồng</option>
                        <option value="3">Con</option>
                        <option value="2">Anh/ Em trai</option>
                        <option value="2">Chị/ Em gái</option>
                    </select>
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
        </div>
        <br><br>
        <button type="submit" class="btn btn-primary text-center taomoi">Tạo mới</button>
      </form>
      {{-- <a href="customers/{{$customerId}}">Quay về</a></td> --}}
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
    .taomoi{
        position: relative;
        left: 500px;
    }
    
</style>
@endsection