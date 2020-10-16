@extends('admin.home')

@section('content')
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
        margin-top: 65px;
        width: 100%;
        height: 170px;
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
    .hienthi-center{
        position: absolute;
        left: 20%;
        top: 0%;
        width: 20%;
        height: 100%;
        padding: 13px;
    }
    .hienthi-right-center{
        position: absolute;
        left: 40%;
        top: 0%;
        width: 20%;
        height: 100%;
        padding: 13px;
    }
    .hienthi-right{
        position: absolute;
        left: 60%;
        top: 0%;
        width: 25%;
        height: 100%;
        padding: 13px;
    }
    .nutsubmit{
        position: absolute;
        right: 2%;
        top: 36%;
        width: 10%;
        height: 20%;
    }
    select{
        height: 35px;
        border-radius: 4px;
    }
</style>
<div class="statistical">
    {{-- <h3 style="text-align: center">Thống Kê Phí Dịch Vụ</h3> --}}
    <div class="menuTime">
        <ul>
            <li>
                <a class="btn btn-secondary" href="{{route('admin.statisticals.index')}}">Thống kê theo mốc thời gian</a>
            </li>
            <li>
                <a class="btn btn-outline-secondary" href="{{route('admin.statistical-month-to-month')}}">Thống kê theo khoảng thời gian</a>
            </li>
        </ul>
    </div>
    <form action="{{ route('admin.statistical', 1)}}" method="get" enctype="multipart/form-data">
    @csrf
    <div class="hienthi">
        <div class="hienthi-left">
            <b>Thống kê theo loại phí</b>
            <br><br>
            <select style="width: 170px" name="type" id="">
                <option selected value="0">Tất cả loại phí</option>
                <option value="1">Phí điện sinh hoạt</option>
                <option value="2">Phí nước sinh hoạt</option>
                <option value="3">Phí gửi xe</option>
                <option value="4">Phí Quản lý vận hành</option>
            </select>
        </div>
        <div class="hienthi-center">
            <b>Thống kê theo Block</b>
            <br><br>
            <select style="width: 170px" name="block" id="">
                <option selected value="0">Tất cả</option>
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
        </div>
        <div class="hienthi-right-center">
            <b>Thống kê theo Tầng</b>
            <br><br>
            <select style="width: 170px" name="floor" id="">
                <option selected value="0">Tất cả</option>
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
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
            </select>
        </div>
        <div class="hienthi-right">
            <b>Theo Mốc</b>
            <br><br>
            <div style="float: left" class="month">
                <b>Tháng</b>
                <select style="width: 70px" name="month" id="">
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
            </div>
            <div style="float: left" class="year">
                &nbsp&nbsp&nbsp<b>Năm</b>
                <select style="width: 70px" name="year" id="">
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
            {{-- <input style="margin-top: 16px" type="reset" class="btn btn-info" value=" Làm mới "> --}}
        </div>
    </div>
</form>
        @if($result == 1)
            <p style="margin:15px; text-align: center; font-weight: bold; font-size: 20px" >{{$title}}:</p>
                <div class="result_processed">
                    <table class="table table-hover">
                        <thead>
                          <tr> 
                            <th scope="col"><p style="text-align: center">Mã</p></th>
                            <th scope="col"><p style="text-align: center">Tên chủ hộ</p></th>
                            <th scope="col"><p style="text-align: center">Địa chỉ</p></th>
                            <th scope="col"><p style="text-align: center">Tháng</p></th>
                            <th scope="col"><p style="text-align: center">Điện</p></th>
                            <th scope="col"><p style="text-align: center">Nước</p></th>
                            <th scope="col"><p style="text-align: center">Gửi xe</p></th>
                            <th scope="col"><p style="text-align: center">Quản lý vận hành chung cư</p></th>
                            <th scope="col"><p style="text-align: center">Tổng tiền</p></th>
                            <th scope="col"><p style="text-align: center">Tra cứu</p></th>
                          </tr>
                        </thead>
                        <tbody>
                        @if($result_processed == 1 || $result_processed == 2)
                            @if($apartmentAddress -> count() > 0) {{-- nếu có thống kê theo block hoặc floor --}}
                                @foreach ($apartmentAddress as $apartment)
                                    @foreach($customers as $key => $customer)
                                        @if($customer->id == $apartment->customer_id)
                                            @php
                                                $totalmoney = 0;
                                            @endphp
                                            <tr>
                                                <td>{{$customer->id}}</td>
                                                <td>{{$customer->name}}</td>
                                                <td>Căn hộ {{ $customer->apartmentAddress['block'].$customer->apartmentAddress['floor'].$customer->apartmentAddress['apartment']}}</td>
                                                <td>
                                                    @foreach($bills as $bill)
                                                        @if($bill->customer_id == $customer->id)
                                                            <p title="Tháng" style="text-align: center">{{ $bill->payment_month}}/{{ $bill->payment_year}}</p>
                                                        @break;
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($bills as $bill)
                                                        @if($bill->customer_id == $apartment->customer_id && $bill->living_expenses_type_id == 1)
                                                        <a title="Tiền điện" href="{{ route('admin.show-bill-detail', [ 1, $bill->id])}}">
                                                            <p style="text-align: center">{{$bill->money_to_pay}}</p>
                                                            @php
                                                                $totalmoney += $bill->money_to_pay;
                                                            @endphp
                                                        </a>  
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($bills as $bill)
                                                        @if($bill->customer_id == $apartment->customer_id && $bill->living_expenses_type_id == 2)
                                                        <a title="Tiền nước" href="{{ route('admin.show-bill-detail', [ 2, $bill->id])}}">
                                                            <p style="text-align: center">{{$bill->money_to_pay}}</p>
                                                            @php
                                                                $totalmoney += $bill->money_to_pay;
                                                            @endphp
                                                        </a>
                                                    @endif
                                                @endforeach
                                                </td>
                                                <td>
                                                    @foreach($bills as $bill)
                                                        @if($bill->customer_id == $apartment->customer_id && $bill->living_expenses_type_id == 3)
                                                        <a title="Tiền gửi xe" href="{{ route('admin.show-bill-detail', [ 3, $bill->id])}}">
                                                            <p style="text-align: center">{{$bill->money_to_pay}}</p>
                                                            @php
                                                                $totalmoney += $bill->money_to_pay;
                                                            @endphp
                                                        </a>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($bills as $bill)
                                                        @if($bill->customer_id == $apartment->customer_id && $bill->living_expenses_type_id == 4)
                                                        <a title="Tiền QLVH Chung cư" href="{{ route('admin.show-bill-detail', [ 4, $bill->id])}}">
                                                            <p style="text-align: center">{{$bill->money_to_pay}}</p>
                                                            @php
                                                                $totalmoney += $bill->money_to_pay;
                                                            @endphp
                                                        </a>
                                                    @endif
                                                @endforeach
                                                </td>
                                                <td>
                                                    <p title="Tổng tiền" style="text-align: center">{{ $totalmoney }}</p>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.bills.show', $customer -> id)}}"><i class="fa fa-search" style="font-size:20px"></i></a>
                                                </td>
                                            </tr>
                                            @php
                                                $totalmoney = 0;
                                            @endphp
                                        @endif
                                    @endforeach
                                @endforeach
                            @endif
                        @endif
                        </tbody>
                      </table>
                </div>
        @endif

        @if($result == 2)
            <p style="margin:15px; text-align: center; font-weight: bold; font-size: 20px" >{{$title}}:</p>
                <div class="result_processed">
                    <table class="table table-hover">
                        <thead>
                          <tr> 
                            <th scope="col"><p >Mã</p></th>
                            <th scope="col"><p >Tên chủ hộ</p></th>
                            <th scope="col"><p >Địa chỉ</p></th>
                            <th scope="col"><p style="text-align: center">Tháng</p></th>
                            @if($typeServices == 1 )
                                <th scope="col"><p style="text-align: center">Tiền Điện</p></th>
                            @elseif($typeServices == 2 )
                                <th scope="col"><p style="text-align: center">Tiền Nước</p></th>
                            @elseif($typeServices == 3 )
                                <th scope="col"><p style="text-align: center">Tiền Gửi xe</p></th>
                            @elseif($typeServices == 4 )
                                <th scope="col"><p style="text-align: center">Tiền Quản lý vận hành chung cư</p></th>
                            @endif
                            <th scope="col"><p >Tra cứu</p></th>
                          </tr>
                        </thead>
                        <tbody>
                        @if($result_processed == 3 || $result_processed == 4)
                            @if($apartmentAddress -> count() > 0) {{-- nếu có thống kê theo block hoặc floor --}}
                                @foreach ($apartmentAddress as $apartment)
                                    @foreach($customers as $key => $customer)
                                        @if($customer->id == $apartment->customer_id)
                                            <tr>
                                                <td>{{$customer->id}}</td>
                                                <td>{{$customer->name}}</td>
                                                <td>Căn hộ {{ $customer->apartmentAddress['block'].$customer->apartmentAddress['floor'].$customer->apartmentAddress['apartment']}}</td>
                                                <td>
                                                    @foreach($bills as $bill)
                                                        @if($bill->customer_id == $customer->id)
                                                            <p title="Tháng" style="text-align: center">{{ $bill->payment_month}}/{{ $bill->payment_year}}</p>
                                                        @break;
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($bills as $bill)
                                                        @if($bill->customer_id == $apartment->customer_id)
                                                            @if($bill->living_expenses_type_id == 1)
                                                            <a title="Tiền điện" href="{{ route('admin.show-bill-detail', [ 1, $bill->id])}}">
                                                                <p style="text-align: center">{{$bill->money_to_pay}}</p>
                                                            </a>  
                                                            @endif
                                                            @if($bill->living_expenses_type_id == 2)
                                                            <a title="Tiền nước" href="{{ route('admin.show-bill-detail', [ 2, $bill->id])}}">
                                                                <p style="text-align: center">{{$bill->money_to_pay}}</p>
                                                            </a>
                                                            @endif
                                                            @if($bill->living_expenses_type_id == 3)
                                                            <a title="Tiền gửi xe" href="{{ route('admin.show-bill-detail', [ 3, $bill->id])}}">
                                                                <p style="text-align: center">{{$bill->money_to_pay}}</p>
                                                            </a>
                                                            @endif
                                                            @if($bill->living_expenses_type_id == 4)
                                                            <a title="Tiền QLVH Chung cư" href="{{ route('admin.show-bill-detail', [ 4, $bill->id])}}">
                                                                <p style="text-align: center">{{$bill->money_to_pay}}</p>
                                                            </a>
                                                            @endif
                                                        @endif
                                                @endforeach
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.bills.show', $customer -> id)}}"><i class="fa fa-search" style="font-size:20px"></i></a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endif
                        @endif
                        </tbody>
                      </table>
                </div>
        @endif
    </div>
@endsection