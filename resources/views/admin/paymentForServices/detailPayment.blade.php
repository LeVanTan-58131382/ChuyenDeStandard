@extends('admin.home')

@section('content')
<div class="detail-payment">
    <h3 style="text-align: center">Chi tiết thanh toán tiền dịch vụ</h3>
    <br>
    <div class="chuho">
        <label for="">1. Họ và tên: {{ $customer->name}}</label><br>
        <label for="">2. Địa chỉ: Block: {{ $customer->apartmentAddress['block'] }} 
                            Tầng: {{ $customer->apartmentAddress['floor']}} 
                            Nhà: {{ $customer->apartmentAddress['apartment']}}</label><br>
    </div>
    <br>
    <form method="post" action="{{ route('admin.store-bill', $customer_id)}}">
        @csrf 
    <div class="row">
        <div class="col-md-12">
            <div class="payment-electric">
                <h4>Phí dịch vụ điện sinh hoạt</h4>
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Chỉ số cũ</th>
                        <th scope="col">Chỉ số mới</th>
                        <th scope="col">Quy định giá phí</th>
                      </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td><input min="0" name="consumptionIndex_E_old" type="number" value=@if($consumptionIndex_E_old)
                                                                                                        {{$consumptionIndex_E_old}}
                                                                                                      @endif></td>
                                <td><input min="0" name="consumptionIndex_E_new" type="number" value=@if($consumptionIndex_E_new)
                                                                                                        {{$consumptionIndex_E_new}}
                                                                                                      @endif></td>
                                <td>
                                    <select name="price_regulation_id_E" id="">
                                        @foreach ($price_regulation_elects as $item)
                                            <option value="{{ $item -> id}}">{{ $item -> name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="payment-water">
                <h4>Phí dịch vụ nước sinh hoạt</h4>
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Chỉ số cũ</th>
                        <th scope="col">Chỉ số mới</th>
                        <th scope="col">Quy định giá phí</th>
                      </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td><input min="0" name="consumptionIndex_W_old" type="number" value=@if($consumptionIndex_W_old)
                                                                                                        {{$consumptionIndex_W_old}}
                                                                                                        @endif></td>
                                <td><input min="0" name="consumptionIndex_W_new" type="number" value=@if($consumptionIndex_W_new)
                                                                                                        {{$consumptionIndex_W_new}}
                                                                                                        @endif></td>
                                <td><select name="price_regulation_id_W" id="">
                                    @foreach ($price_regulation_waters as $item)
                                            <option value="{{ $item -> id}}">{{ $item -> name}}</option>
                                        @endforeach
                                    </select></td>
                            </tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="payment-car">
                <h4>Phí dịch vụ gửi xe</h4>
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Loại xe</th>
                        <th scope="col">Số lượng xe</th>
                        <th scope="col">Quy định giá phí</th>
                      </tr>
                    </thead> 
                    <tbody>
                            <tr>
                                <td>
                                    <b>Xe ô tô</b><br>
                                    <b>Xe máy</b><br>
                                    <b>Xe đạp</b><br>
                                </td>
                                <td>
                                    @foreach ($customer->vehicles as $item)
                                        <b>
                                            <?php
                                                if($item->pivot->vehicle_id == 1 && $item->pivot->using == 1 )
                                                {
                                                    echo $item->pivot->amount;
                                                }
                                            ?>
                                        </b>
                                        <b>
                                            <?php
                                                if($item->pivot->vehicle_id == 2 && $item->pivot->using == 1)
                                                {
                                                    echo $item->pivot->amount;
                                                }
                                            ?>
                                        </b>
                                        <b>
                                            <?php
                                                if($item->pivot->vehicle_id == 3 && $item->pivot->using == 1)
                                                {
                                                    echo $item->pivot->amount;
                                                }
                                            ?>
                                        </b><br>
                                    @endforeach
                                </td>
                                <td><select name="price_regulation_id_C" id="">
                                    @foreach ($price_regulation_cars as $item)
                                            <option value="{{ $item -> id}}">{{ $item -> name}}</option>
                                        @endforeach
                                    </select></td>
                            </tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="payment-car">
                <h4>Phí Quản lý vận hành chung cư</h4>
                <label for="">Chọn quy định giá phí vận hành chung cư</label>
                <select name="price_regulation_id_S" style=" position: relative;left: 110px;">
                    @foreach ($price_regulation_services as $item)
                        <option value="{{ $item -> id}}">{{ $item -> name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary text-center xuat">Xuất hóa đơn</button>
        </div>
    </div>
</form>
<br>
<a style="position: relative; left: 46%;" href="{{ url()->previous() }}" class="btn btn-primary">Quay lại</a>
</div>
<style>
    .detail-payment{
        position: relative;
        left: 0%;
        top: 0%;
        width: 100%;
        height: auto;
        border: 1px solid black;
        border-radius: 5px;
        padding: 30px;
    }

    .chuho{
        position: relative;
        left: 0%;
        top: 0%;
        width: 100%;
        height: auto;
        border: 1px solid black;
        border-radius: 5px;
        padding: 30px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    .detail-payment select, input{
        width: 300px;
        height: 35px;
        border: 1px solid gray;
        padding-left: 25px;
        border-radius: 4px;
    }

    .payment-electric, .payment-water, .payment-car{
        border: 1px solid gray;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .xuat{
        position: relative;
        left: 44.3%;
    }
</style>
@endsection