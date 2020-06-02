@extends('admin.home')

@section('content')
<div class="bill">
    <h4 style="text-align: center">Phí sinh hoạt sử dụng trong tháng của khách hàng</h4>
    <br>
    <div class="bang">
        <table class="table">
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">Tên loại phí</th>
                <th scope="col">Chỉ số tháng trước</th>
                <th scope="col">Chỉ số tháng này</th>
                <th scope="col">Lượng đã dùng</th>
                <th scope="col">Quy định giá phí</th>
                <th scope="col">Thành tiền</th>
                <th scope="col">Tình trạng</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Điện sinh hoạt</td>
                @foreach ($consumptionIndex_E as $item)
                    <td>{{$item->last_month_index}}</td>
                    <td>{{$item->this_month_index}}</td>
                    <td>{{$item->this_month_index - $item->last_month_index}} kWh</td>
                @endforeach
                @foreach ($billElectric as $itembill)
                <td>
                    <?php
                    foreach ($price_regulation as $itemprice){
                        if($itemprice->id == $itembill->price_regulation_id && $itemprice->living_expenses_type_id == 1){
                        echo $itemprice->name;
                    }}
                    ?>
                </td>
                <td>{{$itembill->money_to_pay}} VND</td>
                <td>@php
                    if($itembill->paid == 0){
                                echo "Chưa thanh toán";
                            }
                    else echo "Đã thanh toán";
                @endphp</td>
                @endforeach
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Nước sinh hoạt</td>
                @foreach ($consumptionIndex_W as $item)
                    <td>{{$item->last_month_index}}</td>
                    <td>{{$item->this_month_index}}</td>
                    <td>{{$item->this_month_index - $item->last_month_index}} khối</td>
                @endforeach
                @foreach ($billWater as $itembill)
                <td>
                    <?php
                    foreach ($price_regulation as $itemprice){
                        if($itemprice->id == $itembill->price_regulation_id && $itemprice->living_expenses_type_id == 2){
                        echo $itemprice->name;
                    }}
                    ?>
                </td>
                <td>{{$itembill->money_to_pay}} VND<br>
                <td>@php
                    if($itembill->paid == 0){
                                echo "Chưa thanh toán";
                            }
                    else echo "Đã thanh toán";
                @endphp</td>
                @endforeach
              </tr>
            </tbody>
          </table>
    </div>
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
                    <td>@php
                        if($itembill->paid == 0){
                                    echo "Chưa thanh toán";
                                }
                        else echo "Đã thanh toán";
                    @endphp</td>
                    @endforeach
                @endforeach
                @foreach ($billCar as $itembill)
                <caption style="text-align: center; margin: 20px;"><p style="text-align:center"><b>Tổng cộng: </b>{{$itembill->money_to_pay}} VND</p></caption>
                @endforeach
                </tr>
                </tbody>
              </table>
              <br>
              
        </div>
<div class="bang">
    <h4 style="text-align: center">Chi tiết phí sinh hoạt sử dụng trong tháng của khách hàng</h4>
    <br>
    <div class="chitietdien">
        <table class="table">
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">Tên loại phí</th>
                <th scope="col">Định mức sử dụng</th>
                <th scope="col">Khối lượng sử dụng</th>
                <th scope="col">Đơn giá</th>
                <th scope="col">Thành tiền theo định mức</th>
              </tr>
            </thead>
            <tbody> {{--điện--}}
                <?php
                    $usage_level_max = 0;
                    $price_level = 0;
                    $price_total = 0;
                    (double)$usage_final = 0.0; // chỉ số đã sử dụng
                    $price_regulation_id = 0;
                    foreach ($billElectric as $itembill) {
                        $usage_level_max = $itembill->usage_level_max;
                        $price_total =  $itembill -> money_to_pay;
                        $price_regulation_id = $itembill->price_regulation_id;
                    }
                    foreach ($consumptionIndex_E as $item){
                        $usage_final = $item->this_month_index - $item->last_month_index;
                    }
                
                    for($i = $usage_level_max; $i > 0; $i-- ){
                        foreach ($usage_norm as $usage) {
                            if($usage->living_expenses_type_id == 1 && $usage->price_regulation_id == $price_regulation_id && 
                            $usage_final >= $usage->usage_index_from && $usage_final <= $usage->usage_index_to)
                            {$price_level += ($usage_final - $usage->usage_index_from + 1) * $usage->price;
                            
                            {?>
                                <tr>
                                <td></td>
                                <td>Điện sinh hoạt</td>
                                <td>{{$i}}&nbsp&nbsp({{$usage->usage_index_from}}-{{$usage->usage_index_to}}&nbspKWh)</td>
                                <td>{{$usage_final - $usage->usage_index_from + 1}}</td>
                                <td>{{$usage->price}}</td>
                                <td>{{($usage_final - $usage->usage_index_from + 1) * $usage->price}}</td>
                                </tr>
                            <?php }
    
                            $usage_final -= ($usage_final - $usage->usage_index_from + 1);
                            }
                    }
                    }
                    {?>
                        <caption style="text-align: center; margin: 20px;"><p><b>Tổng tiền điện: </b>{{$price_total}}</p></caption>
                    <?php }
                ?>
            </tbody>
          </table>
    </div>
    <div class="chitietnuoc">
        <table class="table">
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">Tên loại phí</th>
                <th scope="col">Định mức sử dụng</th>
                <th scope="col">Khối lượng sử dụng</th>
                <th scope="col">Đơn giá</th>
                <th scope="col">Thành tiền theo định mức</th>
              </tr>
            </thead>
            <tbody> {{--điện--}}
                <?php
                    $usage_level_max = 0;
                    $price_level = 0;
                    $price_total = 0;
                    $usage_final = 0; // chỉ số đã sử dụng
                    $price_regulation_id = 0;
                    foreach ($billWater as $itembill) {
                        $usage_level_max = $itembill->usage_level_max;
                        $price_total = $itembill -> money_to_pay;
                        $price_regulation_id = $itembill->price_regulation_id;
                    }
                    foreach ($consumptionIndex_W as $item){
                        $usage_final = $item->this_month_index - $item->last_month_index;
                    }
                    
                    for($i = $usage_level_max; $i > 0; $i-- ){
                        foreach ($usage_norm as $usage) {
                            if($usage->living_expenses_type_id == 2 && $usage->price_regulation_id == $price_regulation_id && 
                            $usage_final >= $usage->usage_index_from && $usage_final <= $usage->usage_index_to)
                            {$price_level += ($usage_final - $usage->usage_index_from + 1) * $usage->price;
                            
                            {?>
                                <tr>
                                <td></td>
                                <td>Nước sinh hoạt</td>
                                <td>{{$i}}&nbsp&nbsp({{$usage->usage_index_from}}-{{$usage->usage_index_to}}&nbspKWh)</td>
                                <td>{{$usage_final - $usage->usage_index_from + 1}}</td>
                                <td>{{$usage->price}}</td>
                                <td>{{($usage_final - $usage->usage_index_from + 1) * $usage->price}}</td>
                                </tr>
                            <?php }
    
                            $usage_final -= ($usage_final - $usage->usage_index_from + 1);
                            }
                    }
                    }
                    {?>
                        <caption style="text-align: center; margin: 20px;"><p><b>Tổng tiền nước: </b>{{$price_total}}</p></caption>
                    <?php }
                ?>
            </tbody>
          </table>
    </div>
</div>
      
      
      


<style>
    .bill{
        position: relative;
        left: 0%;
        top: 0%;
        width: 100%;
        height: 2000px;
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