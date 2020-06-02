
@extends('admin.home')

@section('content')
<div class="list-mes">
    <h3 style="text-align: center">Danh sách tin nhắn</h3>
    <a class="btn btn-dark" href="{{ route('create-mes')}}">Tạo tin nhắn mới</a>
    <br>
    @foreach ($messages as $mes)
    <a href="{{ route('read-mes', $mes->id)}}"><div class="row">
        <div class="col-md-12">
            <div class="mes">
                <div class="header-mes">
                    <div class="header-left">
                        <p>Tin nhắn từ:
                            @foreach ($users as $user)
                                @php
                                    if($user->id == $mes->user_id_from && $user->id != 1)
                                    {
                                        echo $user->name;
                                    }
                                    elseif($user->id == $mes->user_id_from && $user->id == 1){
                                        echo "Quản trị viên";
                                    }
                                @endphp
                            @endforeach   
                        </p>
                    </div>
                    <div class="header-right">
                        <p>Đến:
                            @foreach ($users as $user)
                            @php
                                if($user->id == $mes->user_id_to && $user->id != 1)
                                {
                                    echo $user->name;
                                }
                                elseif($user->id == $mes->user_id_to && $user->id == 1){
                                    echo "Quản trị viên";
                                }
                            @endphp
                        @endforeach  
                        </p> 
                    </div>
                </div>
                <div class="content-mes">
                    <div class="apart-content">
                        {{$mes->title}}
                    </div>
                    <div class="status">
                        @if($mes->read == 1)
                            <p>20/5 &nbsp&nbsp Đã xem</p>
                        @endif
                        @if($mes->read == 0)
                            <p>20/5 &nbsp&nbsp Chưa xem</p>
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
        width: 20%;
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