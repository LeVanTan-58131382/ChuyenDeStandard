@extends('customer.home')

@section('content')
<style>
    .comment-item{
        position: relative;
        width: 400px;
        height: auto;
        background-color: white;
        border: 1px solid black;
        color: #343a40;
        border-radius: 5px;
        margin: 30px;
        margin-bottom: 0px;
        float: left;
        padding: 10px;
    }

    .bill{
        position: relative;
        left: 5%;
        top: 0%;
        width: 95%;
        height: auto;
        /* background-color: -webkit-linear-gradient(top right, #00d8c2, #0068b7);
        background-image: -webkit-linear-gradient(right top, rgb(0, 216, 194), rgb(0, 104, 183)); */
        background-color: #007bff;
        border: 1px solid white;
        color: white;
        border-radius: 5px;
        padding: 10px;
    }
    .bang{
        background-color: white;
        border: 1px solid grey;
        color: #343a40;
        border-radius: 9px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .chitietdien, .chitietnuoc{
        background-color: white;
        border: 1px solid grey;
        color: #343a40;
        border-radius: 9px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .comment{
        position: relative;
        left: 0%;
        top: 0%;
        width: 100%;
        height: auto;
        border: 1px solid gray;
        background-color: lightslategrey;
        color: black;
        border-radius: 9px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    #nutgui{
        position: absolute;
        width: 100px;
        left: 400px;
    }
    #nutgui:hover{ 
        box-shadow: 0 4px 8px 0 rgba(0, 255, 255, 0.8), 0 6px 20px 0 rgba(0, 255, 255, 0.8);
    }
</style>
<div class="bill wow fadeInRight">
    @php
        $idBillE = 0;
        $idBillW = 0;
    @endphp
    <br>
    <div class="bang">
        <h4 style="text-align: center">Hóa Đơn Tiền Điện</h4>
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
                            $idBillE = $itembill->id;
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
                            $idBillW = $itembill->id;
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
        <div class="form-group">
            <label for="">1. Họ và tên: {{ $customer->name}}</label><br>
            <label for="">2. Địa chỉ: Block: {{ $customer->apartmentAddress['block'] }} 
                            Tầng: {{ $customer->apartmentAddress['floor']}} 
                            Nhà: {{ $customer->apartmentAddress['apartment']}}</label><br>
            @foreach ($billCar as $itembill)
                <label for="">3. Tháng sử dụng dịch vụ: {{$itembill->payment_month}}/{{$itembill->payment_year}}</label><br>
            @endforeach
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
<div class="comment">
    <div class="row">
        <div class="col-md-12">
            <h4>Khách hàng để lại bình luận tại đây</h4>
            <form action="{{ route('customer.create-cmt', [$customer->id, $idBillE, $idBillW])}}" method="post">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlInput1">Tiêu đề</label>
                <input required type="text" class="form-control" name="title" placeholder="Nhập tiêu đề bình luận">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Nội dung</label>
            <textarea required class="form-control" name="content" rows="3"></textarea>
            </div>
            <div class="form-group">
                <input id="nutgui" class="btn btn-outline-light" type="submit" value="Gửi">
            </div>
    </form>
        </div>
    </div>
    <br><br>
    @if(count($comments) > 0)
    <h4 style="text-align: center">Một số nội dung bình luận</h4>
    @foreach ($comments as $cmt)
    <div class="row">
        <div class="col-md-12">
            @if($cmt->customer_id == 1)
            <p style='float:right; color: white'>Quản trị viên</p>
            <br>
            @endif
            @if($cmt->customer_id > 1)
            <p style=" color: white">Khách hàng</p>
            @endif
            <div class="comment-item" 
            @if($cmt->customer_id == 1)
                style='float:right; right:-90px'
            @endif
            >
                <b>{{ $cmt->title}}</b>
                <hr>
                <p>{{ $cmt->content}}</p>
            </div>
        </div>
    </div>
    <hr>
    @endforeach
    @endif
</div>
    

@endsection