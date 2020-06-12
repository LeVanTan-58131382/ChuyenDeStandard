@extends('admin.home')

@section('content')
<div class="statistical">
    {{-- <h3 style="text-align: center">Thống Kê Phí Dịch Vụ</h3> --}}
    <div class="menuTime">
        <ul>
            <li>
                <a class="btn btn-outline-secondary" href="{{route('admin.statisticals.index')}}">Thống kê theo mốc thời gian</a>
            </li>
            <li>
                <a class="btn btn-secondary" href="{{route('admin.statistical-month-to-month')}}">Thống kê theo khoảng thời gian</a>
            </li>
        </ul>
    </div>
    <form action="{{ route('admin.statistical')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="hienthi">
        <div class="hienthi-left">
            <b>Thống kê theo loại phí</b>
            <br><br>
            <select style="width: 170px" name="type" id="">
                <option selected value="1">Phí điện sinh hoạt</option>
                <option value="2">Phí nước sinh hoạt</option>
                <option value="3">Phí gửi xe</option>
            </select>
        </div>
        <div class="hienthi-left-center">
            <b>Thống kê theo chủ hộ</b>
            <br><br>
            <select style="width: 170px" name="customer" id="">
                <option selected value="0">Tất cả</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="hienthi-right">
            <b>Theo Khoảng Thời Gian</b>
            <br><br>
            <div class="timeFrom">
                <b>Từ tháng</b>&nbsp&nbsp
                <select style="width: 70px" name="monthFrom" id="">
                    <option selected value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
                <b>Năm</b>
                <select style="width: 70px" name="yearFrom" id="">
                    <option selected value="{{ $calendar -> year}}">{{ $calendar -> year}}</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                </select>
            </div>
            <br>
            <div class="timeTo">
                <b>Đến tháng</b>
                <select style="width: 70px" name="monthTo" id="">
                    @if($calendar->month > 1)
                    <option selected value="{{ ($calendar->month)-1}}">{{ ($calendar->month)-1}}</option>
                    @elseif($calendar->month == 1)
                    <option selected value="12">12</option>
                    @endif
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
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
                <b>Năm</b>
                <select style="width: 70px" name="yearTo" id="">
                    @if($calendar->month > 1)
                    <option selected value="{{ $calendar->year}}">{{ $calendar->year}}</option>
                    @elseif($calendar->month == 1)
                    <option selected value="{{ ($calendar->year)-1}}">{{ ($calendar->year)-1}}</option>
                    @endif
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                </select>
            </div>
        </div>
        <div class="nutsubmit">
            <input type="submit" class="btn btn-info" value="Thực hiện">
        </div>
    </div>
</form>
    @if($result == 1)
        <div class="result">
            @if($result_processed == 2)
            <b style="margin:auto" >{{$title}}:</b>
            <br><br>
                <div class="result_processed">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">Mã khách hàng</th>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Tháng thanh toán</th>
                            <th scope="col">Tiền đã thanh toán</th>
                          </tr>
                        </thead>
                        <tbody>
                                @foreach ($bills as $bill)
                                    @if($bill -> count() > 0)
                                        @if(($bill -> customer_id) == ($customer_result -> id))
                                            <tr>
                                                <th scope="row">{{ $customer_result -> id }}</th>
                                                <td>{{ $customer_result -> name }}</td>
                                                <td>
                                                    Căn hộ {{ $customer_result->apartmentAddress['block'].$customer_result->apartmentAddress['floor'].$customer_result->apartmentAddress['apartment']}}
                                                </td>
                                                <td>{{$bill->payment_month}}</td>
                                                <td>
                                                    {{$bill->money_to_pay}}
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
                        </tbody>
                      </table>
                </div>
            @endif
            @if($result_processed == 3)
            <b style="margin:auto" >{{$title}}:</b>
            <br><br>
                <div class="result_processed">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">Mã khách hàng</th>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Tháng thanh toán</th>
                            <th scope="col">Tiền đã thanh toán</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                @foreach ($bills as $bill)
                                    @if($bill -> count() > 0)
                                        @if(($bill -> customer_id) == ($customer -> id))
                                            <tr>
                                                <th scope="row">{{ $customer -> id }}</th>
                                                <td>{{ $customer -> name }}</td>
                                                <td>
                                                    Căn hộ {{ $customer->apartmentAddress['block'].$customer->apartmentAddress['floor'].$customer->apartmentAddress['apartment']}}
                                                </td>
                                                <td>{{$bill->payment_month}}</td>
                                                <td>
                                                    {{$bill->money_to_pay}}
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                      </table>
                </div>
            @endif
        </div>
    @endif
</div>
<style>
    .statistical{
        position: relative;
        left: 0%;
        top: 0%;
        width: 100%;
        height: auto;
        border: 1px solid black;
        border-radius: 5px;
        padding: 30px;
    }
    .result{
        position: relative;
        width: 100%;
        height: auto;
        margin-top: 20px;
    }
    .menuTime{
        position: relative;
    }
    .menuTime li{
        list-style: none;
        float: left;
        margin-right: 5px;
    }
    .hienthi{
        position: relative;
        width: 100%;
        height: 170px;
        margin-top: 65px;
        padding: 5px;
        right: 0%;
        border: 1px solid gray;
        border-radius: 5px;
    }
    .hienthi-left{
        position: absolute;
        left: 0%;
        top: 0%;
        width: 20%;
        height: 100%;
        padding: 13px;
    }
    .hienthi-left-center{
        position: absolute;
        left: 23%;
        top: 0%;
        width: 20%;
        height: 100%;
        padding: 13px;
    }
    .hienthi-right{
        position: absolute;
        left: 46%;
        top: 0%;
        width: 40%;
        height: 100%;
        padding: 13px;
    }
    .nutsubmit{
        position: absolute;
        right: 10%;
        top: 36%;
        width: 10%;
        height: 20%;
    }
    select{
        height: 35px;
        border-radius: 4px;
    }
</style>
@endsection