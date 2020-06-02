@extends('customer.home')

@section('content')
<div class="bill wow fadeInRight">
    @php
        $idBillE = 0;
        $idBillW = 0;
        $idBillC = 0;
        $idCus = 0;
    @endphp
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
                <td>
                    @php
                        if($itembill->paid == 0){
                                    echo "Chưa thanh toán";
                                }
                        else echo "Đã thanh toán";
                    @endphp
                </td>
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
                <td>
                    @php
                        if($itembill->paid == 0){
                                    echo "Chưa thanh toán";
                                }
                        else echo "Đã thanh toán";
                    @endphp
                    </td>
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
                    <td></td>
                    @endforeach
                @endforeach
                @foreach ($billCar as $itembill)
                @php
                    $idBillC = $itembill->id;
                @endphp
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
                    $usage_final = 0; // chỉ số đã sử dụng
                    $price_regulation_id = 0;
                    foreach ($billElectric as $itembill) {
                        $idBillE = $itembill->id;
                        $idCus = $itembill->user_id;
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
            <tbody> {{--nước--}}
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
<div class="comment">
    <div class="row">
        <div class="col-md-12">
            <h4>Khách hàng để lại bình luận tại đây</h4>
            <form action="{{ route('create-cmt', [$idCus, $idBillE, $idBillW, $idBillC])}}" method="post">
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
                <input class="btn btn-outline-primary nutgui" type="submit" value="Gửi">
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
            @if($cmt->user_id == 99999)
            <p style='float:right'>Quản trị viên</p>
            @endif
            @if($cmt->user_id != 99999)
            <p>Khách hàng</p>
            @endif
            <div class="comment-item" 
            @if($cmt->user_id == 99999)
                style='float:right'
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
        background-color: #343a40;
        border: 1px solid white;
        color: white;
        border-radius: 5px;
        padding: 10px;
    }
    .bang{
        background-color: white;
        border: 1px solid black;
        color: #343a40;
        border-radius: 9px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .chitietdien, .chitietnuoc{
        background-color: white;
        border: 1px solid black;
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
        border-radius: 9px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .nutgui:hover{
        box-shadow: 0 4px 8px 0 rgba(0, 255, 255, 0.8), 0 6px 20px 0 rgba(0, 255, 255, 0.8);
    }
</style>
@endsection