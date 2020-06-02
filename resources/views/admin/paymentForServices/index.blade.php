@extends('admin.home')

@section('content')
<div class="payment-service">
    <h3 style="text-align: center">Danh sách khách hàng và Tình trạng thanh toán</h3>
    <div class="hienthi">
        <div class="hienthi-left">
            <b>Hiển thị theo loại phí</b>
            <br><br>
            <ul>
                <li>
                    <a class="btn btn-secondary" href="{{route('list-calBill')}}">Tất cả</a>
                </li>
                <li>
                    <a class="btn btn-outline-secondary" href="{{route('show-BillE')}}">Phí điện sinh hoạt</a>
                </li>
                <li>
                    <a class="btn btn-outline-secondary" href="{{route('show-BillW')}}">Phí nước sinh hoạt</a>
                </li>
                <li>
                    <a class="btn btn-outline-secondary" href="{{route('show-BillC')}}">Phí gửi xe</a>
                </li>
            </ul>
        </div>
        <div class="hienthi-right">
            <b>Tình trạng</b>
            <br><br>
            <ul>
                <a class="btn btn-outline-secondary" href=""><li>Chưa thanh toán</li></a>
                <a class="btn btn-outline-secondary" href=""><li>Đã thanh toán</li></a>
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
                    <th scope="col">Tính tiền thanh toán</th>
                    <th scope="col">Hóa đơn</th>
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
                                if((($bill -> user_id) == ($user -> id)) && ($bill -> living_expenses_type_id == 1))
                            {
                                {?>
                                <a style="text-decoration: none;" href="{{ route('create-calBill', $user -> id)}}">Đã xuất hóa đơn</a>&nbsp <i class="fa fa-check-square-o" style="font-size:20px;color:green"></i>
                                <script>
                                    jQuery(document).ready(function($) {
                                        $('#chamthang{{$user->id}}').css({'opacity':'0'},{'visibility':'hidden'});
                                    });
                                </script>
                                <?php }
                            }
                            ?>
                            <a id="chamthang{{$user->id}}" style="text-decoration: none;" href="{{ route('create-calBill', $user -> id)}}">Chưa xuất hóa đơn&nbsp<i class="fa fa-exclamation-circle" style="font-size:20px;color:red"></i></a>
                        </td>
                        <td><a href="{{ route('show-Bill', $user -> id)}}"><i class="fa fa-search" style="font-size:20px"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
        {{ $listUsers->links() }}
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