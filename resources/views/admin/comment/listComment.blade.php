
@extends('admin.home')

@section('content')
<div class="list-mes">
    <h3 style="text-align: center">Danh sách bình luận</h3>
    <br>
    @foreach ($comments as $cmt)
    <a href="{{ route('admin.comment-read', $cmt->id)}}"><div class="row">
        <div class="col-md-12">
            <div class="mes">
                <div class="header-mes">
                    <div class="header-left">
                        <p>Bình luận từ:
                            @php
                                if($cmt->customer_id == 1){
                                        echo "Quản trị viên";
                                    }
                            @endphp
                            @foreach ($customers as $customer)
                                @php
                                    if($customer->id == $cmt->customer_id)
                                    {
                                        echo $customer->name;
                                    }
                                @endphp
                            @endforeach   
                        </p>
                    </div>
                </div>
                <div class="content-mes">
                    <div class="apart-content">
                        {{$cmt->title}}
                    </div>
                    <div class="status">
                        <p>
                           @php
                               echo \Carbon\Carbon::createFromTimeStamp(strtotime($cmt["created_at"]))->diffForHumans();
                           @endphp 
                            @if($cmt->read == 0)
                                &nbsp Chưa xem
                            @else &nbsp Đã xem
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div></a>
    <br>
    @endforeach
</div>
<style>
    .list-mes{
        position: relative;
        left: 0%;
        top: 0%;
        width: 100%;
        height: 100%;
        border: 1px solid black;
        border-radius: 5px;
        padding: 30px;
    }

    .mes{
        position: relative;
        width: 70%;
        height: 120px;
        margin: auto;
        background-color: #343a40;
        color: white
        margin-bottom: 20px;
        border-radius: 4px;
        padding: 10px;
        overflow: hidden;
        cursor: pointer;
    }

    .header-mes{
        position: absolute;
        width: 100%;
        height: 30%;
        top: 0%;
        left: 0%;
        background-color: #343a40;
        color: white
    }

    .content-mes{
        position: absolute;
        width: 100%;
        height: 70%;
        bottom: 0%;
        left: 0%;
        background-color: #17a2b8;
        color: white
    }

    .apart-content{
        position: absolute;
        width: 60%;
        height: 30%;
        left: 2%;
        top: 30%;
        overflow: hidden;
    }

    .status{
        position: absolute;
        width: 15%;
        height: 30%;
        right: 2%;
        top: 30%;
        overflow: hidden;
    }

    .header-left{
        position: absolute;
        width: 40%;
        height: 100%;
        left: 0%;
        top: 0%;
        margin: 5px;
    }
    .header-right{
        position: absolute;
        width: 40%;
        height: 100%;
        left: 40%;
        top: 0%;
        margin: 5px;
    }
    
</style>
@endsection