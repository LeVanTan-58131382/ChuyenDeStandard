@extends('customer.home')

@section('content')
<div class="profile wow fadeInRight">
    <h3 style="text-align: center">Hồ sơ khách hàng</h3>
    <br>
    <p><b>Mã Khách hàng: </b>{{ $user -> id}}</p>
    <p><b>Họ tên: </b>{{ $user -> name}}</p>
    <p><b>Ngày sinh: </b>15/08/1998</p>
    <p><b>Giới tính: </b>Nam</p>
    <p><b>Địa chỉ: </b>Block: {{ $apartment -> block}} Tầng: {{ $apartment -> floor}} Nhà: {{ $apartment -> apartment}}</p>
    <p><b>Số điện thoại: </b>{{ $user -> phone}}</p>
    <p><b>Email: </b>{{ $user -> email}}</p>
</div>

<style>
    /* profile */
    .profile{
        position: absolute;
        top: 0%;
        left: 5%;
        width: 95%;
        height: auto;
        border-radius: 5px;
        padding: 50px;
        font-size: 20px;
        margin: 20px;
        margin-top: 0px;
        margin-left: 0px;
        background-color: #343a40;
        border: 1px solid white;
        color: white;
    }
</style>
@endsection

