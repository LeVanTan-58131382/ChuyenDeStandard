@extends('customer.home')

@section('content')
<div class="notpaid wow fadeInRight">
    <h3>Khách hàng chưa được xuất hóa đơn!</h3>
</div>
<style>
    .notpaid{
        position: absolute;
        top: 0%;
        left: 5%;
        width: 95%;
        height: auto;
        background-color: #343a40;
        border: 1px solid white;
        color: white;
        border-radius: 5px;
        padding: 50px;
        font-size: 20px;
        margin: 20px;
        margin-top: 0px;
    }
    
</style>
@endsection