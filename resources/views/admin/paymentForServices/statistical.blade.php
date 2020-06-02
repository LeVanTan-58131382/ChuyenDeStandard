@extends('admin.home')

@section('content')
<div class="statistical">
    <p><b>Tổng tiền phí điện sinh hoạt đã thu của tháng:&nbsp </b>{{ $totalmoneyE}} &nbsp VND</p>
    <br>
    <p><b>Tổng tiền phí nước sinh hoạt đã thu của tháng:&nbsp </b>{{ $totalmoneyW}} &nbsp VND</p>
    <br>
    <p><b>Tổng tiền phí dịch vụ gửi xe đã thu của tháng:&nbsp </b>{{ $totalmoneyC}} &nbsp VND</p>
    <br>
</div>
<style>
    .statistical{
        position: relative;
        left: 0%;
        top: 0%;
        width: 100%;
        height: 700px;
        border: 1px solid black;
        border-radius: 5px;
        padding: 30px;
    }

</style>
@endsection