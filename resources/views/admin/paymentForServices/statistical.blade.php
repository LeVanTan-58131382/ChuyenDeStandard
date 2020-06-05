@extends('admin.home')

@section('content')
<div class="statistical">
    <h3 style="text-align: center">Thống Kê Phí Dịch Vụ</h3>
    <form action="" method="post">
    @csrf
    <div class="hienthi">
        <div class="hienthi-left">
            <b>Thống kê theo loại phí</b>
            <br><br>
            <select style="width: 170px" name="type" id="">
                <option value="">Phí điện sinh hoạt</option>
                <option value="">Phí nước sinh hoạt</option>
                <option value="">Phí gửi xe</option>
            </select>
        </div>
        <div class="hienthi-left-center">
            <b>Thống kê theo chủ hộ</b>
            <br><br>
            <select style="width: 170px" name="type" id="">
                <option value="">Tất cả</option>
            </select>
        </div>
        <div class="hienthi-right-center">
            <b>Theo Mốc</b>
            <br><br>
            <div class="month">
                <b>Tháng</b>
                <select style="width: 70px" name="month" id="">
                    <option selected value="0">Không chọn</option>
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
            <br>
            <div class="year">
                <b>Năm</b>&nbsp&nbsp&nbsp
                <select style="width: 70px" name="year" id="">
                    <option selected value="0">Không chọn</option>
                    <option value="">2019</option>
                    <option value="">2020</option>
                    <option value="">2021</option>
                    <option value="">2022</option>
                </select>
            </div>
        </div>
        <div class="hienthi-right">
            <b>Theo Khoảng Thời Gian</b>
            <br><br>
            <div class="timeFrom">
                <b>Từ tháng</b>&nbsp&nbsp
                <select style="width: 70px" name="monthFrom" id="">
                    <option selected value="0">Không chọn</option>
                    <option value="">1</option>
                    <option value="">2</option>
                    <option value="">3</option>
                    <option value="">4</option>
                    <option value="">5</option>
                    <option value="">6</option>
                    <option value="">7</option>
                    <option value="">8</option>
                    <option value="">9</option>
                    <option value="">10</option>
                    <option value="">11</option>
                    <option value="">12</option>
                </select>
                <b>Năm</b>
                <select style="width: 70px" name="yearFrom" id="">
                    <option selected value="0">Không chọn</option>
                    <option value="">2019</option>
                    <option value="">2020</option>
                    <option value="">2021</option>
                    <option value="">2022</option>
                </select>
            </div>
            <br>
            <div class="timeTo">
                <b>Đến tháng</b>
                <select style="width: 70px" name="monthTo" id="">
                    <option selected value="0">Không chọn</option>
                    <option value="">1</option>
                    <option value="">2</option>
                    <option value="">3</option>
                    <option value="">4</option>
                    <option value="">5</option>
                    <option value="">6</option>
                    <option value="">7</option>
                    <option value="">8</option>
                    <option value="">9</option>
                    <option value="">10</option>
                    <option value="">11</option>
                    <option value="">12</option>
                </select>
                <b>Năm</b>
                <select style="width: 70px" name="yearTo" id="">
                    <option selected value="0">Không chọn</option>
                    <option value="">2019</option>
                    <option value="">2020</option>
                    <option value="">2021</option>
                    <option value="">2022</option>
                </select>
            </div>
        </div>
        <div class="nutsubmit">
            <input type="submit" class="btn btn-info" value="Thực hiện">
        </div>
    </div>
</form>
    @if($result == 0)
        <div class="result">
            @if($result_1 == 1)
                <div class="result_1"></div>
            @endif
            @if($result_2 == 1)
                <div class="result_1"></div>
            @endif
            @if($result_3 == 1)
                <div class="result_1"></div>
            @endif
        </div>
    @endif
</div>
<style>
    .statistical{
        position: relative;
        left: 0%;
        top: 0%;
        width: 100%;
        height: auto;
        border: 1px solid black;
        border-radius: 5px;
        padding: 30px;
    }
    .result{
        position: relative;
        width: 100%;
        height: auto;
        background-color: white;
    }
    .hienthi{
        position: relative;
        width: 100%;
        height: 170px;
        padding: 5px;
        right: 0%;
        border: 1px solid gray;
        border-radius: 5px;
    }
    .hienthi-left{
        position: absolute;
        left: 0%;
        top: 0%;
        width: 20%;
        height: 100%;
        padding: 13px;
    }
    .hienthi-left-center{
        position: absolute;
        left: 23%;
        top: 0%;
        width: 20%;
        height: 100%;
        padding: 13px;
    }
    .hienthi-right-center{
        position: absolute;
        left: 46%;
        top: 0%;
        width: 15%;
        height: 100%;
        padding: 13px;
    }
    .hienthi-right{
        position: absolute;
        left: 62%;
        top: 0%;
        width: 28%;
        height: 100%;
        padding: 13px;
    }
    .nutsubmit{
        position: absolute;
        right: 0%;
        top: 37%;
        width: 10%;
        height: 20%;
    }
    select{
        height: 35px;
        border-radius: 4px;
    }
</style>
@endsection