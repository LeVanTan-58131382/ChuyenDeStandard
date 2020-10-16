@extends('customer.home')
@section('content')
<style>
    .bill{
        position: relative;
        left: 5%;
        top: 0%;
        width: 95%;
        height: auto;
        background-color: #007bff;
        border: 1px solid white;
        color: white;
        border-radius: 5px;
        padding: 10px;
    }

    .table{
        color: white;
    }
</style>
<div class="bill wow fadeInRight">
    <h4 style="text-align: center">Lịch sử thanh toán hóa đơn</h4>
    <table class="table">
        <caption>Lịch sử thanh toán hóa đơn</caption>
        <thead>
          <tr>
            <th scope="col">Mã hóa đơn</th>
            <th scope="col">Loại phí dịch vụ</th>
            <th scope="col">Tháng sử dụng</th>
            <th scope="col">Số tiền thanh toán (VND)</th>
            <th scope="col">Tình trạng</th>
            <th scope="col">Tra cứu</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($bills as $bill)
                <tr>
                    <th scope="row">{{$bill->id}}</th>
                    <td>
                        @if($bill->living_expenses_type_id == 1)
                        <p>Điện</p>
                        @elseif($bill->living_expenses_type_id == 2)
                        <p>Nước</p>
                        @elseif($bill->living_expenses_type_id == 3)
                        <p>Gửi xe</p>
                        @elseif($bill->living_expenses_type_id == 4)
                        <p>Quản lý vận hành chung cư</p>
                        @endif
                    </td>
                    <td>{{$bill->payment_month}}/{{$bill->payment_year}}</td>
                    <td>{{$bill->money_to_pay}}</td>
                    <td>
                        @if($bill->paid == 1)
                        <p>Đã thanh toán</p>
                        @elseif($bill->paid == 0)
                        <p>Chưa thanh toán</p>
                        @endif
                    </td>
                    <td><a style="color: white" href="{{route('customer.list-bills', [Auth::user()->id, $bill->payment_month, $bill->payment_year])}}">Chi tiết</a></td>
                </tr>
            @endforeach
          
        </tbody>
      </table>

</div>
@endsection