@extends('admin.home')

@section('content')
<div class="detail-payment">
    <h3 style="text-align: center">Chi tiết thanh toán tiền dịch vụ</h3>
    <br>
    <form method="post" action="{{ route('store-calBill', $user_id)}}">
        @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="payment-electric">
                <h4>Phí dịch vụ điện sinh hoạt</h4>
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Chỉ số tháng trước</th>
                        <th scope="col">Chỉ số tháng này</th>
                        <th scope="col">Quy định giá phí</th>
                      </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td><input min="0" name="consumptionIndex_E_old" type="number" value="{{ old('consumptionIndex_E_old') }}"></td>
                                <td><input min="0" name="consumptionIndex_E_new" type="number" value="{{ old('consumptionIndex_E_new') }}"></td>
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
                        <th scope="col">Chỉ số tháng trước</th>
                        <th scope="col">Chỉ số tháng này</th>
                        <th scope="col">Quy định giá phí</th>
                      </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td><input min="0" name="consumptionIndex_W_old" type="number" value="{{ old('consumptionIndex_W_old') }}"></td>
                                <td><input min="0" name="consumptionIndex_W_new" type="number" value="{{ old('consumptionIndex_W_new') }}"></td>
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
                      </tr>
                    </thead> 
                    <tbody>
                            <tr>
                                <td>
                                    <b>Xe ô tô</b><br>
                                    <b>Xe mô tô</b><br>
                                    <b>Xe đạp</b><br>
                                </td>
                                <td>
                                    @foreach ($vehicles as $item)
                                        <b>
                                            <?php
                                                if($item->vehicle_type_id == 1)
                                                {
                                                    echo $item->amount;
                                                }
                                            ?>
                                        </b>
                                        <b>
                                            <?php
                                                if($item->vehicle_type_id == 2)
                                                {
                                                    echo $item->amount;
                                                }
                                            ?>
                                        </b>
                                        <b>
                                            <?php
                                                if($item->vehicle_type_id == 3)
                                                {
                                                    echo $item->amount;
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
            <button type="submit" class="btn btn-success text-center">Xuất hóa đơn</button>
        </div>
    </div>
</form>
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
    .detail-payment select, input{
        width: 300px;
        height: 35px;
        border-radius: 4px;
    }

    .payment-electric, .payment-water, .payment-car{
        border: 1px solid gray;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
</style>
@endsection