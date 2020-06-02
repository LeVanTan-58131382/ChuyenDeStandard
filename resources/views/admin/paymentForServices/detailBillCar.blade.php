@extends('admin.home')

@section('content')
<div class="bill">
    <br>
        <h4 style="text-align: center">Phí dịch vụ gửi xe sử dụng trong tháng của khách hàng</h4>
        <br>
        <div class="bang">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Tên loại phí</th>
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
                        <td>Dịch vụ gửi xe </td>
                        <td>
                            <?php
                            if($item->vehicle_type_id == 1)
                            echo 'Ô tô';
                            elseif($item->vehicle_type_id == 2)
                            echo 'Xe máy';
                            elseif($item->vehicle_type_id == 3)
                            echo 'Xe đạp';
                            ?>
                        </td>
                        <td>{{$item->amount}}</td>
                        @foreach ($billCar as $itembill)
                    <td>
                        <?php
                        foreach ($price_regulation as $itemprice){
                            if($itemprice->id == $itembill->price_regulation_id && $itemprice->living_expenses_type_id == 3){
                            echo $itemprice->name;
                        }}
                        ?>
                    </td>
                    <td>
                        <?php
                        foreach ($vehicles_prices as $itemprice){
                            if($itemprice->price_regulation_id == $itembill->price_regulation_id && $itemprice->vehicle_type_id == 1 && $item->vehicle_type_id == 1){
                                echo $itemprice->price;
                            }
                            elseif($itemprice->price_regulation_id == $itembill->price_regulation_id && $itemprice->vehicle_type_id == 2 && $item->vehicle_type_id == 2){
                                echo $itemprice->price;
                            }
                            elseif($itemprice->price_regulation_id == $itembill->price_regulation_id && $itemprice->vehicle_type_id == 3 && $item->vehicle_type_id == 3){
                                echo $itemprice->price;
                            }
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                        foreach ($vehicles_prices as $itemprice){
                            if($itemprice->price_regulation_id == $itembill->price_regulation_id && $itemprice->vehicle_type_id == 1 && $item->vehicle_type_id == 1){
                                //dd($itemprice->price*$item->amount) ; // nếu là ô tô
                                echo ($itemprice->price*$item->amount);
                            }
                            elseif($itemprice->price_regulation_id == $itembill->price_regulation_id && $itemprice->vehicle_type_id == 2 && $item->vehicle_type_id == 2){
                                //dd($itemprice->price*$item->amount) ; // nếu là xe máy
                                echo ($itemprice->price*$item->amount);
                            }
                            elseif($itemprice->price_regulation_id == $itembill->price_regulation_id && $itemprice->vehicle_type_id == 3 && $item->vehicle_type_id == 3){
                                //dd($itemprice->price*$item->amount) ; // nếu là xe đạp
                                echo ($itemprice->price*$item->amount);
                            }
                            }
                        ?>
                    </td>
                    <td></td>
                    @endforeach
                @endforeach
                @foreach ($billCar as $itembill)
                <caption style="text-align: center; margin: 20px;"><p style="text-align:center"><b>Tổng cộng: </b>{{$itembill->money_to_pay}} VND</p></caption>
                @endforeach
                </tr>
                <tr>
                    @foreach ($billCar as $item)
                    <?php
                    if($item->paid == 0)
                        {
                            {?>
                                <caption style="text-align: center; margin: 20px;"><a class="btn btn-info" href="{{route('payc', $item->user_id )}}">Khách hàng đã thanh toán</a></caption>
                            <?php }
                        }
                    ?> 
                    @endforeach
                    </tr>
                </tbody>
              </table>
              <br>
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