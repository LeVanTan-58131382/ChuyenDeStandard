@extends('admin.home')

@section('content')
<div class="bill">
    <br>
    <div class="bang">
        <h4 style="text-align: center">Hóa Đơn Tiền Điện</h4>
        <div class="capnhattinhtrang">
            @foreach ($billElectric as $itembill)
                <form action="{{ route('admin.update-status-paid', [$itembill->id, 1])}}" method="POST">
                    @csrf
                    <select name="updatePaidE" id="">
                        @if($itembill->paid == 0)
                            <option selected value="0">Chưa Thanh Toán</option>
                            <option value="1">Đã Thanh Toán</option>
                        @elseif($itembill->paid == 1)
                            <option value="0">Chưa Thanh Toán</option>
                            <option selected value="1">Đã Thanh Toán</option>
                        @endif
                    </select>
                    <input type="submit" class="capnhat" value="Cập nhật">
                </form>
            @endforeach
        </div>
        <div class="form-group">
            <label for="">1. Họ và tên: {{ $customer->name}}</label><br>
            <label for="">2. Địa chỉ: Block: {{ $customer->apartmentAddress['block'] }} 
                            Tầng: {{ $customer->apartmentAddress['floor']}} 
                            Nhà: {{ $customer->apartmentAddress['apartment']}}</label><br>
            @foreach($consumptionIndex_E as $consumptionIndex)
            <label for="">3. Chỉ số cũ: {{ $consumptionIndex->last_month_index}}</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<label for="">Chỉ số mới: {{ $consumptionIndex->this_month_index}}</label><br>
            @endforeach
            @foreach ($billElectric as $itembill)
                <label for="">4. Tháng tiêu thụ: {{$itembill->payment_month}}/{{$itembill->payment_year}}</label><br>
            @endforeach
            <label for="">5. Điện tiêu thụ:</label><br>
            <br>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Định mức sử dụng (KWh)</th>
                    <th scope="col">Khối lượng sử dụng (KWh)</th>
                    <th scope="col">Đơn giá (VND)</th>
                    <th scope="col">Thành tiền theo định mức (VND)</th>
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
                                    <td>{{$i}}&nbsp&nbsp({{$usage->usage_index_from}}-{{$usage->usage_index_to}}&nbspKWh)</td>
                                    <td>{{$usage_final - $usage->usage_index_from + 1}}&nbspKWh</td>
                                    <td>{{$usage->price}}</td>
                                    <td>{{($usage_final - $usage->usage_index_from + 1) * $usage->price}}</td>
                                    </tr>
                                <?php }
        
                                $usage_final -= ($usage_final - $usage->usage_index_from + 1);
                                }
                        }
                        }
                        {?>
                            <caption style="text-align: center; margin: 20px;"><p><b>Tổng tiền điện: </b>{{$price_total}} &nbspVND</p></caption>
                        <?php }
                    ?>
                </tbody>
              </table>
        </div>
    </div>
    <div class="bang">
        <h4 style="text-align: center">Hóa Đơn Tiền Nước</h4>
        <div class="capnhattinhtrang">
            @foreach ($billWater as $itembill)
                <form action="{{ route('admin.update-status-paid', [$itembill->id, 2])}}" method="POST">
                    @csrf
                        <select name="updatePaidW" id="">
                            @if($itembill->paid == 0)
                                <option selected value="0">Chưa Thanh Toán</option>
                                <option value="1">Đã Thanh Toán</option>
                            @elseif($itembill->paid == 1)
                                <option value="0">Chưa Thanh Toán</option>
                                <option selected value="1">Đã Thanh Toán</option>
                            @endif
                        </select>
                        <input type="submit" class="capnhat" value="Cập nhật">
                </form>
            @endforeach
        </div>
        <div class="form-group">
            <label for="">1. Họ và tên: {{ $customer->name}}</label><br>
            <label for="">2. Địa chỉ: Block: {{ $customer->apartmentAddress['block'] }} 
                            Tầng: {{ $customer->apartmentAddress['floor']}} 
                            Nhà: {{ $customer->apartmentAddress['apartment']}}</label><br>
            @foreach($consumptionIndex_W as $consumptionIndex)
            <label for="">3. Chỉ số cũ: {{ $consumptionIndex->last_month_index}}</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<label for="">Chỉ số mới: {{ $consumptionIndex->this_month_index}}</label><br>
            @endforeach
            
            @foreach ($billWater as $itembill)
                <label for="">4. Tháng tiêu thụ: {{$itembill->payment_month}}/{{$itembill->payment_year}}</label><br>
            @endforeach
            <label for="">5. Nước tiêu thụ:</label><br>
            <br>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Định mức sử dụng (Mét khối)</th>
                    <th scope="col">Khối lượng sử dụng (Mét khối)</th>
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
                                    <td>{{$i}}&nbsp&nbsp({{$usage->usage_index_from}}-{{$usage->usage_index_to}}&nbspMét khối)</td>
                                    <td>{{$usage_final - $usage->usage_index_from + 1}}&nbspMét khối</td>
                                    <td>{{$usage->price}}</td>
                                    <td>{{($usage_final - $usage->usage_index_from + 1) * $usage->price}}</td>
                                    </tr>
                                <?php }
        
                                $usage_final -= ($usage_final - $usage->usage_index_from + 1);
                                }
                        }
                        }
                        {?>
                            <caption style="text-align: center; margin: 20px;"><p><b>Tổng tiền nước: </b>{{$price_total}} &nbspVND</p></caption>
                        <?php }
                    ?>
                </tbody>
              </table>
        </div>
    </div>
    <br>
    <br>
    <div class="bang">
        <h4 style="text-align: center">Phí dịch vụ gửi xe</h4>
        <div class="capnhattinhtrang">
            @foreach ($billCar as $itembill)
                <form action="{{ route('admin.update-status-paid', [$itembill->id, 3])}}" method="POST">
                    @csrf
                        <select name="updatePaidC" id="">
                            @if($itembill->paid == 0)
                                <option selected value="0">Chưa Thanh Toán</option>
                                <option value="1">Đã Thanh Toán</option>
                            @elseif($itembill->paid == 1)
                                <option value="0">Chưa Thanh Toán</option>
                                <option selected value="1">Đã Thanh Toán</option>
                            @endif
                        </select>
                        <input type="submit" class="capnhat" value="Cập nhật">
                </form>
            @endforeach
        </div>
        <div class="form-group">
            <label for="">1. Họ và tên: {{ $customer->name}}</label><br>
            <label for="">2. Địa chỉ: Block: {{ $customer->apartmentAddress['block'] }} 
                            Tầng: {{ $customer->apartmentAddress['floor']}} 
                            Nhà: {{ $customer->apartmentAddress['apartment']}}</label><br>
            @foreach ($billCar as $itembill)
                <label for="">3. Tháng sử dụng dịch vụ: {{$itembill->payment_month}}/{{$itembill->payment_year}}</label><br>
            @endforeach
            <label for="">4. Phí giữ xe:</label><br>
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
                @if($vehicles->count() > 0)
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
                        if($itemprice->price_regulation_id == $itembill->price_regulation_id && $itemprice->vehicle_type_id == 1 && $item->vehicle_id == 1){
                            echo $itemprice->price;
                        }
                        elseif($itemprice->price_regulation_id == $itembill->price_regulation_id && $itemprice->vehicle_type_id == 2 && $item->vehicle_id == 2){
                            echo $itemprice->price;
                        }
                        elseif($itemprice->price_regulation_id == $itembill->price_regulation_id && $itemprice->vehicle_type_id == 3 && $item->vehicle_id == 3){
                            echo $itemprice->price;
                        }
                        }
                    ?>
                </td>
                <td>
                    <?php
                    foreach ($vehicles_prices as $itemprice){
                        if($itemprice->price_regulation_id == $itembill->price_regulation_id && $itemprice->vehicle_type_id == 1 && $item->vehicle_id == 1){
                            //dd($itemprice->price*$item->amount) ; // nếu là ô tô
                            echo ($itemprice->price*$item->amount);
                        }
                        elseif($itemprice->price_regulation_id == $itembill->price_regulation_id && $itemprice->vehicle_type_id == 2 && $item->vehicle_id == 2){
                            //dd($itemprice->price*$item->amount) ; // nếu là xe máy
                            echo ($itemprice->price*$item->amount);
                        }
                        elseif($itemprice->price_regulation_id == $itembill->price_regulation_id && $itemprice->vehicle_type_id == 3 && $item->vehicle_id == 3){
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
            @endif
            @foreach ($billCar as $itembill)
            <caption style="text-align: center; margin: 20px;"><p style="text-align:center"><b>Tổng cộng: </b>{{$itembill->money_to_pay}}&nbspVND</p></caption>
            @endforeach
            </tr>
            </tbody>
            </table>
            <br>
        </div>
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
        position: relative;
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
    .capnhattinhtrang{
        position: absolute;
        width: 300px;
        height: 60px;
        top: 60px;
        right: 100px;
        padding-top: 10px;
    }
    select{
        width: 150px;
        height: 40px;
        border-radius: 4px;
    }
    .capnhat{
        width: 100px;
        height: 40px;
        border-radius: 5px;
        background-color: aqua;
    }
</style>
@endsection