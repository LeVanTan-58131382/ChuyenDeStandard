
@extends('customer.home')

@section('content')
<div class="list-mes wow fadeInRight">
    <h3 style="text-align: center; color:white">Danh sách tin nhắn</h3>
    <a class="btn nuttaotinnhan" href="{{ route('create-mes-cus')}}">Tạo tin nhắn mới</a>
    <br>
    @foreach ($messages as $mes)
    <a href="{{ route('read-mes-cus', $mes->id)}}"><div class="row">
        <div class="col-md-12">
            <div class="mes">
                <div class="header-mes">
                    <div class="header-left">
                    <p>Tin nhắn từ: {{ "Quản trị viên" }}</p>
                    </div>
                    <div class="header-right">
                        <p>Đến:
                            @php
                                if($user->id == $mes->user_id_to && $user->id != 1)
                                {
                                    echo $user->name;
                                }
                                elseif($user->id == $mes->user_id_to && $user->id == 1){
                                    echo "Quản trị viên";
                                }
                            @endphp
                        </p> 
                    </div>
                </div>
                <div class="content-mes">
                    <div class="apart-content">
                        {{$mes->title}}
                    </div>
                    <div class="status-mes">
                        <p>
                            @php
                                echo \Carbon\Carbon::createFromTimeStamp(strtotime($mes["created_at"]))->diffForHumans();
                                if($mes->read == 0){
                                    echo "&nbsp Chưa xem";
                                }
                                else echo "&nbsp Đã xem";
                            @endphp
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div></a>
    @endforeach
</div>
<style>
    /* .list-mes{
        position: relative;
        left: 0%;
        top: 0%;
        width: 100%;
        height: auto;
        background-color: #343a40;
        border: 1px solid white;
        color: white;
        border-radius: 5px;
        padding: 30px;
        margin: 20px;
        margin-top: 0px;
    } */

    .nuttaotinnhan{
        position: absolute;
        left: 20px;
        top: 0px;
        background-color: #343a40;
        color: white;
        transition: 0.5s;
        border: 1px solid white;
		}
    .nuttaotinnhan:hover{
        background-color: white;
        color: #007bff;
        box-shadow: 0 4px 8px 0 rgba(0, 255, 255, 1), 0 6px 20px 0 rgba(0, 255, 255, 1);
    }

    .mes{
        position: relative;
        width: 70%;
        height: 120px;
        margin: auto;
        margin-bottom: 20px;
        background-color: #343a40;
        color: white;
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
        background-color: white;
        color: #343a40;
    }

    .content-mes{
        position: absolute;
        width: 100%;
        height: 70%;
        bottom: 0%;
        left: 0%;
        background-color: #343a40;
    }

    .apart-content{
        position: absolute;
        width: 60%;
        height: 100%;
        left: 2%;
        top: 30%;
        overflow: hidden;
    }

    .status-mes{
        position: absolute;
        height: 100%;
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