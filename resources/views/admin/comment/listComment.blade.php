
@extends('admin.home')

@section('content')
<div class="list-mes">
    <h3 style="text-align: center">Danh sách comment</h3>
    <br>
    @foreach ($comments as $cmt)
    <a href="{{ route('read-cmt-ad', $cmt->id)}}"><div class="row">
        <div class="col-md-12">
            <div class="mes">
                <div class="header-mes">
                    <div class="header-left">
                        <p>Bình luận từ:
                            @php
                                if($cmt->user_id == 1){
                                        echo "Quản trị viên";
                                    }
                            @endphp
                            @foreach ($users as $user)
                                @php
                                    if($user->id == $cmt->user_id)
                                    {
                                        echo $user->name;
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
                        <p>20/5 &nbsp&nbsp Đã xem</p>
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