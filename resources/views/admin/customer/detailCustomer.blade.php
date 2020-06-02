
@extends('admin.home')

@section('content')
<div class="detail-customer">
    <h3>Chi tiết khách hàng</h3>
    <br>
    <p>Mã Khách hàng: {{ $user -> id}}</p>
    <p>Họ tên: {{ $user -> name}}</p>
    <p>Email: {{ $user -> email}}</p>
    <p>Địa chỉ: Block: {{ $apartment -> block}} Tầng: {{ $apartment -> floor}} Nhà: {{ $apartment -> apartment}}</p>
    <p>Số điện thoại: {{ $user -> phone}}</p>
</div>
<style>
    .detail-customer{
        position: relative;
        left: 0%;
        top: 0%;
        width: 100%;
        height: 1000px;
        border: 1px solid black;
        border-radius: 5px;
        padding: 30px;
    }
</style>
@endsection