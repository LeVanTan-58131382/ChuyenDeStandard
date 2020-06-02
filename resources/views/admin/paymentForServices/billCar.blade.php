@extends('admin.home')

@section('content')
<div class="payment-service">
    <h3 style="text-align: center">Danh sách khách hàng và Tình trạng thanh toán Phí gửi xe</h3>
    <div class="hienthi">
        <div class="hienthi-left">
            <b>Hiển thị theo loại phí</b>
            <br><br>
            <ul>
                <li>
                    <a class="btn btn-outline-secondary" href="{{route('list-calBill')}}">Tất cả</a>
                </li>
                <li>
                    <a class="btn btn-outline-secondary" href="{{route('show-BillE')}}">Phí điện sinh hoạt</a>
                </li>
                <li>
                    <a class="btn btn-outline-secondary" href="{{route('show-BillW')}}">Phí nước sinh hoạt</a>
                </li>
                <li>
                    <a class="btn btn-secondary" href="{{route('show-BillC')}}">Phí gửi xe</a>
                </li>
            </ul>
        </div>
        <div class="hienthi-right">
            <b>Tình trạng</b>
            <br><br>
            <ul>
                <a class="btn btn-outline-secondary" href="{{route('show-BillC-notpaid')}}"><li>Chưa thanh toán</li></a>
                <a class="btn btn-outline-secondary" href="{{route('show-BillE-paid')}}"><li>Đã thanh toán</li></a>
            </ul>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Mã khách hàng</th>
                    <th scope="col">Tên khách hàng</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Tiền phải thanh toán</th>
                    <th scope="col">Trạng thái thanh toán</th>
                    <th scope="col">Hóa đơn</th>
                    <th scope="col">Gửi thông báo</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($listUsers as $user)
                    <tr>
                        <th scope="row">{{ $user -> id }}</th>
                        <td>{{ $user -> name }}</td>
                        <td>
                            <?php foreach($apartments as $apart)
                                        if(($apart -> user_id) == ($user -> id))
                                        {
                                           echo 'Căn hộ '.$apart->block.$apart->floor.$apart->apartment;
                                        }
                                    ?>
                        </td>
                        <td>
                            <?php foreach($bills as $bill)
                            if(($bill -> user_id) == ($user -> id))
                            {
                               echo $bill->money_to_pay;
                            }
                            
                        ?>
                        </td>
                        <td>
                            <?php foreach ($bills as $bill)
                            if(($bill -> user_id) == ($user -> id) && $bill -> paid == 0)
                            {
                                {?>
                                    Chưa thanh toán &nbsp<i class="fa fa-exclamation-circle" style="font-size:20px;color:red"></i>
                                <?php }
                            }
                            else if(($bill -> user_id) == ($user -> id) && $bill -> paid == 1)
                            {
                                {?>
                                    Đã thanh toán &nbsp<i class="fa fa-check-square-o" style="font-size:20px;color:green"></i>
                                <?php }
                            }
                            ?>
                        </td>
                        <td><a href="{{ route('show-BillC-detail', $user -> id)}}"><i class="fa fa-search" style="font-size:20px"></i></a></td>
                        <td>
                            <?php foreach ($bills as $bill)
                            if(($bill -> user_id) == ($user -> id) && $bill -> paid == 0)
                            {
                                {?>
                                    <a href="{{ route('bill-notifi', $bill->id)}}"><i class='far fa-bell' style='font-size:20px'></i></a>
                                <?php }
                            }
                            ?>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
<style>
    .payment-service{
        position: relative;
        left: 0%;
        top: 0%;
        width: 100%;
        height: auto;
        border: 1px solid black;
        border-radius: 5px;
        padding: 30px;
    }

    .hienthi{
        position: relative;
        width: 1000px;
        height: 110px;
        padding: 5px;
        margin: 10px;
        right: 0%;
        border: 1px solid gray;
        border-radius: 5px;
    }
    .hienthi-left li, .hienthi-right li{
        list-style: none;
        float: left;
        margin-right: 5px;
    }
    .hienthi-left{
        position: absolute;
        left: 0%;
        top: 0%;
        width: 60%;
        height: 100%;
        padding: 10px;
    }
    .hienthi-right{
        position: absolute;
        right: 0%;
        top: 0%;
        width: 40%;
        height: 100%;
        padding: 10px;
    }
    
</style>
@endsection