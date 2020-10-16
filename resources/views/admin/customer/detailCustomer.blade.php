
@extends('admin.home')

@section('content')
<div class="detail-customer">
    <a class="btn btn-dark" href="{{ route('admin.family-member-create', $customer -> id)}}">Thêm thành viên gia đình</a>
    <h3>Chi tiết Chủ hộ</h3>
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
    <p><b>Diện tích căn hộ:&nbsp</b>{{ $customer->apartmentAddress['acreage']}} mét vuông</p>
    <p><b>Số điện thoại:&nbsp;&nbsp;&nbsp;&nbsp;</b> {{ $customer -> phone}}</p>

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
    <br>
    <a style="position: relative; left: 46%;" href="{{ url()->previous() }}" class="btn btn-primary">Quay lại</a>
</div>
<style>
    .detail-customer{
        position: relative;
        left: 0%;
        top: 0%;
        width: 100%;
        height: auto;
        border: 1px solid black;
        border-radius: 5px;
        padding: 30px;
    }
    h3{
        text-align: center;
    }
    .member{
        position: relative;
        border: 1px solid black;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
    }
</style>
@endsection