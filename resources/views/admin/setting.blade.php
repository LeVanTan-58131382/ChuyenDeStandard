@extends('admin.home')

@section('content')
<div class="setting">
    <h3 style="text-align: center">Cài đặt</h3>
    <br><br>
    <form action="{{ route('admin.post-setting')}}" method="post">
        @csrf
        <div class="month">
            <label for="formGroupExampleInput">Tháng</label>
            <select name="month">
                <option selected value="{{ $calendar->month}}">{{ $calendar->month}}</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
        </div>
        <div class="year">
            <label for="formGroupExampleInput">Năm</label>
            <select name="year" id="">
                <option selected value="{{ $calendar->year}}">{{ $calendar->year}}</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
            </select>
        </div>
        <br>
        <div class="indexs">
            <div class="">
                <p>Số lượng xe <b>ô tô</b> tối đa chủ hộ có thể đang ký &nbsp&nbsp&nbsp&nbsp
                    <input type="number" min="0" name="max_car"  placeholder="Nhập số lượng tối đa"
                    value="{{ $setting_indexs->highest_number_of_cars}}"
                    >
                </p> 
            </div>
            <div class="">
                <p>Số lượng xe <b>mô tô</b> tối đa chủ hộ có thể đang ký &nbsp
                    <input type="number" min="0" name="max_moto"  placeholder="Nhập số lượng tối đa"
                    value="{{ $setting_indexs->highest_number_of_motos}}"
                    >
                </p>
            </div>
            <div class="">
                <p>Số lượng xe <b>đạp</b> tối đa chủ hộ có thể đang ký &nbsp&nbsp&nbsp&nbsp&nbsp
                    <input type="number" min="0" name="max_bike"  placeholder="Nhập số lượng tối đa"
                    value="{{ $setting_indexs->highest_number_of_bikes}}"
                    >
                </p>
            </div>
        </div>
        <br>
        <input type="submit" class="btn btn-primary submit" value="Cập nhật" name="" id="">
    </form>
</div>
<style>
    .setting{
        position: relative;
        left: 0%;
        top: 0%;
        width: 100%;
        height: 1000px;
        border: 1px solid black;
        border-radius: 5px;
        padding: 30px;
    }
    select{
        width: 70px;
        height: 35px;
        border-radius: 4px;
    }
    .month, .year {
        position: relative;
        float: left;
        margin-right: 30px;
        margin-left: 30px;
    }
    .indexs{
        position: absolute;
        top: 200px;
        left: 60px;
    }
    .indexs input{
        width: 200px;
        height: 35px;
        padding: 4px;
        border: 1px solid gray;
        border-radius: 5px;
    }
    .submit{
        position: absolute;
        left: 60px;
        top: 370px;
    }
</style>
@endsection