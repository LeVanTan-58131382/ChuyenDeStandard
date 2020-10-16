@extends('admin.home')

@section('content')
<div class="bill">
    <div class="bang">
        <h4 style="text-align: center">Hóa Đơn Tiền Nước</h4>
        <div class="form-group">
            <label for="">1. Họ và tên: {{ $customer->name}}</label><br>
            <label for="">2. Địa chỉ: Block: {{ $customer->apartmentAddress['block'] }} 
                            Tầng: {{ $customer->apartmentAddress['floor']}} 
                            Nhà: {{ $customer->apartmentAddress['apartment']}}</label><br>
                            @foreach($consumptionIndex_W as $consumptionIndex)
                            <label for="">4. Tháng tiêu thụ: {{$consumptionIndex->month_consumption}}/{{$consumptionIndex->year_consumption}}</label><br>
                            <label for="">3. Chỉ số cũ: {{ $consumptionIndex->last_month_index}}</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<label for="">Chỉ số mới: {{ $consumptionIndex->this_month_index}}</label><br>
                            @endforeach
            <label for="">4. Nước tiêu thụ:</label><br>
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
                        $usage_level_max = $bill->usage_level_max;
                        $price_total = $bill -> money_to_pay;
                        $price_regulation_id = $bill->price_regulation_id;
                        
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
        <a style="position: relative; left: 46%;"  href="{{ url()->previous() }}" class="btn btn-primary">Quay lại</a>
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