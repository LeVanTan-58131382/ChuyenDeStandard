@extends('admin.home')

@section('content')
<div class="bill">
    <div class="bang">
        <h4 style="text-align: center">Phí dịch vụ gửi xe</h4>
        <div class="form-group">
            <label for="">1. Họ và tên: {{ $customer->name}}</label><br>
            <label for="">2. Địa chỉ: Block: {{ $customer->apartmentAddress['block'] }} 
                            Tầng: {{ $customer->apartmentAddress['floor']}} 
                            Nhà: {{ $customer->apartmentAddress['apartment']}}</label><br>
            <label for="">3. Phí giữ xe:</label><br>
            <br>
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Loại phương tiện</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Quy định giá phí</th>
                <th scope="col">Đơn giá</th>
                <th scope="col">Thành tiền</th>
                <th>Tình trạng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehicles as $item)
                <tr>
                    <th scope="row"></th>
                    <td>
                        <?php
                        if($item->vehicle_id == 1)
                        echo 'Ô tô';
                        elseif($item->vehicle_id == 2)
                        echo 'Xe máy';
                        elseif($item->vehicle_id == 3)
                        echo 'Xe đạp';
                        ?>
                    </td>
                    <td>{{$item->amount}}</td>
                <td>
                    <?php
                    foreach ($price_regulation as $itemprice){
                        if($itemprice->id == $bill->price_regulation_id && $itemprice->living_expenses_type_id == 3){
                        echo $itemprice->name;
                    }}
                    ?>
                </td>
                <td>
                    <?php
                    foreach ($vehicles_prices as $itemprice){
                        if($itemprice->price_regulation_id == $bill->price_regulation_id && $itemprice->vehicle_type_id == 1 && $item->vehicle_id == 1){
                            echo $itemprice->price;
                        }
                        elseif($itemprice->price_regulation_id == $bill->price_regulation_id && $itemprice->vehicle_type_id == 2 && $item->vehicle_id == 2){
                            echo $itemprice->price;
                        }
                        elseif($itemprice->price_regulation_id == $bill->price_regulation_id && $itemprice->vehicle_type_id == 3 && $item->vehicle_id == 3){
                            echo $itemprice->price;
                        }
                        }
                    ?>
                </td>
                <td>
                    <?php
                    foreach ($vehicles_prices as $itemprice){
                        if($itemprice->price_regulation_id == $bill->price_regulation_id && $itemprice->vehicle_type_id == 1 && $item->vehicle_id == 1){
                            //dd($itemprice->price*$item->amount) ; // nếu là ô tô
                            echo ($itemprice->price*$item->amount);
                        }
                        elseif($itemprice->price_regulation_id == $bill->price_regulation_id && $itemprice->vehicle_type_id == 2 && $item->vehicle_id == 2){
                            //dd($itemprice->price*$item->amount) ; // nếu là xe máy
                            echo ($itemprice->price*$item->amount);
                        }
                        elseif($itemprice->price_regulation_id == $bill->price_regulation_id && $itemprice->vehicle_type_id == 3 && $item->vehicle_id == 3){
                            //dd($itemprice->price*$item->amount) ; // nếu là xe đạp
                            echo ($itemprice->price*$item->amount);
                        }
                        }
                    ?>
                </td>
                <td>@php
                    if($bill->paid == 0){
                                echo "Chưa thanh toán";
                            }
                    else echo "Đã thanh toán";
                @endphp</td>
                @endforeach
            
            <caption style="text-align: center; margin: 20px;"><p style="text-align:center"><b>Tổng cộng: </b>{{$bill->money_to_pay}}&nbspVND</p></caption>
            
            </tr>
            </tbody>
            </table>
            <br>
    </div>
    <a style="position: relative; left: 46%;" href="{{ url()->previous() }}" class="btn btn-primary">Quay lại</a>
</div>
</div>
<style>
    .bill{
        position: relative;
        left: 0%;
        top: 0%;
        width: 100%;
        height: auto;
        border: 1px solid black;
        border-radius: 5px;
        padding: 30px;
    }
    .bang{
        border: 1px solid gray;
        border-radius: 9px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .chitietdien, .chitietnuoc{
        border: 1px solid gray;
        border-radius: 9px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
</style>
@endsection