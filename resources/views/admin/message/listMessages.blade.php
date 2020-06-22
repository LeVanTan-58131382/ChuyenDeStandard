
@extends('admin.home')

@section('content')
<div class="list-mes">
    <h3 style="text-align: center">Danh sách tin nhắn</h3>
    <a class="btn btn-dark" href="{{ route('admin.create-messages')}}">Tạo tin nhắn mới</a>
    <br>
    @foreach ($messages as $mes)
    <a href="{{ route('admin.read-messages', $mes->id)}}"><div class="row">
        <div class="col-md-12">
            <div class="mes">
                <div class="header-mes">
                    <div class="header-left">
                        <p>Tin nhắn từ:
                            @php
                            foreach ($customers as $customer)
                            {
                                if($customer->id == $mes->user_id_from)
                                {
                                    echo $customer->name;
                                }
                                elseif($mes->user_id_from == 1){
                                    echo "Quản trị viên";
                                    break;
                                }
                            }
                            @endphp 
                        </p>
                    </div>
                    <div class="header-right">
                        <p>Đến:
                            @php
                            foreach ($customers as $customer)
                            {
                                if($customer->id == $mes->user_id_to)
                                {
                                    echo $customer->name;
                                }
                                elseif($mes->user_id_to == 1){
                                    echo "Quản trị viên";
                                    break;
                                }
                            }
                            @endphp  
                        </p> 
                    </div>
                </div>
                <div class="content-mes">
                    <div class="apart-content">
                        {{$mes->title}}
                    </div>
                    <div class="status">
                        @php
                             echo \Carbon\Carbon::createFromTimeStamp(strtotime($mes["created_at"]))->diffForHumans();
                        @endphp
                        
                        @if($mes->read_admin == 1)
                            &nbsp&nbsp Đã xem
                        @endif
                        @if($mes->read_admin == 0)
                            &nbsp&nbsp Chưa xem
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div></a>
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
        width: 30%;
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