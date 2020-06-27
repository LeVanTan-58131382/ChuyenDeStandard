@extends('admin.home')

@section('content')
<script >
    $(document).ready(function(){
        $('.addfiles1').on('click', function() { 
            $('#nutimport1').click();
            return false;});
        $('.addfiles2').on('click', function() { 
            $('#nutimport2').click();
            return false;});
});
    
</script>
<div class="payment-service">
    <h3 style="text-align: center">Danh sách chủ hộ và Tình trạng thanh toán</h3>
    <div class="hienthi">
        <div class="hienthi-left">
            <b>Hiển thị theo loại phí</b>
            <br><br>
            <ul>
                <li>
                    <a class="btn btn-secondary" href="{{route('admin.bills.index')}}">Tất cả</a>
                </li>
                <li>
                    <a class="btn btn-outline-secondary" href="{{route('admin.show-bill', 1)}}">Phí điện sinh hoạt</a>
                </li>
                <li>
                    <a class="btn btn-outline-secondary" href="{{route('admin.show-bill', 2)}}">Phí nước sinh hoạt</a>
                </li>
                <li>
                    <a class="btn btn-outline-secondary" href="{{route('admin.show-bill', 3)}}">Phí gửi xe</a>
                </li>
            </ul>
            <br><br>
            <ul>
                <li><form action="{{ route('admin.post-import-water')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <p>Chọn file excel <b>nước</b> tiêu thụ</p> 
                    <button class="addfiles1 btn nutimport1">Bấm để chọn file</button>
                    <input id="nutimport1" class="file btn" type="file" name="file" style='display: none;' multiple>
                    <br>
                    <button class="file btn nutimport" type="submit">Tải lên</button>
                    </form>
                </li>
                <li>&nbsp&nbsp|&nbsp&nbsp</li>
                <li><form action="{{ route('admin.post-import-electric')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <p>Chọn file excel <b>điện</b> tiêu thụ</p> 
                    <button class="addfiles2 btn nutimport2">Bấm để chọn file</button>  
                    <input id="nutimport2" class="file btn" type="file" name="file" style='display: none;' multiple>
                    <br>
                    <button class="file btn nutimport" type="submit">Tải lên</button>
                    </form>
                </li>
            </ul>
        </div>
        <div class="hienthi-right">
            <b>Tình trạng</b>
            <br><br>
            <ul>
                <a class="btn btn-outline-secondary" href=""><li>Chưa xuất hóa đơn</li></a>
                <a class="btn btn-outline-secondary" href=""><li>Đã xuất hóa đơn</li></a>
            </ul>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover noidungbang hienlen">
                <thead>
                  <tr>
                    <th scope="col">Mã chủ hộ</th>
                    <th scope="col">Tên chủ hộ</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Trạng thái hóa đơn</th>
                    <th scope="col">Hóa đơn</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                    <tr>
                        <th scope="row">{{ $customer -> id }}</th>
                        <td>{{ $customer -> name }}</td>
                        <td>
                            <?php foreach($apartments as $apart)
                                        if(($apart -> customer_id) == ($customer -> id))
                                        {
                                           echo 'Căn hộ '.$apart->block.$apart->floor.$apart->apartment;
                                        }
                                    ?>
                        </td>
                        <td>
                           @foreach($bills as $bill)
                                @if((($bill -> customer_id) == ($customer -> id)) && ($bill -> living_expenses_type_id == 1) && ($bill -> payment_month == $month-1))
                                <a style="text-decoration: none;" href="{{ route('admin.create-bill', $customer -> id)}}">Đã xuất hóa đơn</a>&nbsp <i class="fa fa-check-square-o" style="font-size:20px;color:green"></i>
                                <script>
                                    jQuery(document).ready(function($) {
                                        $('#chamthang{{$customer -> id}}').css({'opacity':'0'},{'visibility':'hidden'});
                                    });
                                </script>
                                @endif
                            @endforeach
                            <a id="chamthang{{$customer->id}}" style="text-decoration: none;" href="{{ route('admin.create-bill', $customer -> id)}}">Chưa xuất hóa đơn&nbsp<i class="fa fa-exclamation-circle" style="font-size:20px;color:red"></i></a>
                        </td>
                        <td><a href="{{ route('admin.bills.show', $customer -> id)}}"><i class="fa fa-search" style="font-size:20px"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              {{-- bảng cho các khách hàng chưa được xuất hóa đơn --}}
              {{-- <table class="table table-hover noidungbang">
                <thead>
                  <tr>
                    <th scope="col">Mã khách hàng</th>
                    <th scope="col">Tên khách hàng</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Trạng thái hóa đơn</th>
                    <th scope="col">Hóa đơn</th>
                  </tr>
                </thead>
                <tbody>
                    
                    @foreach($bills as $bill)
                    @if($bill -> living_expenses_type_id == 1)
                    
                    @foreach ($customers as $customer)
                            @if($bill -> customer_id != $customer -> id )
                            @php
                        dd($bill);
                    @endphp
                                @if($bill -> count() < 0)
                                    <tr>
                                        <th scope="row">{{ $customer -> id }}</th>
                                        <td>{{ $customer -> name }}</td>
                                        <td>
                                            @foreach($apartments as $apart)
                                                @if(($apart -> customer_id) == ($customer -> id))
                                                    Căn hộ {{$apart->block.$apart->floor.$apart->apartment}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <a id="chamthang{{$customer->id}}" style="text-decoration: none;" href="{{ route('admin.create-bill', $customer -> id)}}">Chưa xuất hóa đơn&nbsp<i class="fa fa-exclamation-circle" style="font-size:20px;color:red"></i></a>
                                        </td>
                                        <td><a href="{{ route('admin.bills.show', $customer -> id)}}"><i class="fa fa-search" style="font-size:20px"></i></a></td>
                                    </tr>
                                @endif
                                @endif
                        @endforeach
                        @endif
                    @endforeach
                </tbody>
              </table>
              {{-- bảng cho các khách hàng đã được xuất hóa đơn 
              <table class="table table-hover noidungbang">
                <thead>
                  <tr>
                    <th scope="col">Mã khách hàng</th>
                    <th scope="col">Tên khách hàng</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Trạng thái hóa đơn</th>
                    <th scope="col">Hóa đơn</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                    @foreach($bills as $bill)
                            @if(($bill -> customer_id == $customer -> id ) && ($bill -> living_expenses_type_id == 1))
                                    <tr>
                                        <th scope="row">{{ $customer -> id }}</th>
                                        <td>{{ $customer -> name }}</td>
                                        <td>
                                            @foreach($apartments as $apart)
                                                @if(($apart -> customer_id) == ($customer -> id))
                                                    Căn hộ {{$apart->block.$apart->floor.$apart->apartment}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <a style="text-decoration: none;" href="{{ route('admin.create-bill', $customer -> id)}}">Đã xuất hóa đơn</a>&nbsp <i class="fa fa-check-square-o" style="font-size:20px;color:green"></i>
                                        </td>
                                        <td><a href="{{ route('admin.bills.show', $customer -> id)}}"><i class="fa fa-search" style="font-size:20px"></i></a></td>
                                    </tr>
                            @endif
                        @endforeach
                    @endforeach
                </tbody>
              </table> --}}
        </div>
        <div style="position: relative; margin: auto">{{ $customers->links() }}</div>
    </div>
</div>
<style>
    .file{
        width: 170px;
        margin-right: 10px;
        margin-bottom: 10px;
    }

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
        height: 265px;
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
    .nutimport, .nutimport1, .nutimport2{
        width: 200px;
        background-color: #337ab7;
        margin-bottom: 8px;
        color: white;
    }
    
    .nutimport:hover, .nutimport1:hover, .nutimport2:hover{
        background-color:lightseagreen;
        color: white;
    }
</style>
@endsection