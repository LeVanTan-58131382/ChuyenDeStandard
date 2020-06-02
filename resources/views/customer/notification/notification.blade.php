@extends('customer.home')

@section('content')
@foreach ($notificationUser as $notifiu)
    @foreach ($notifications as $notifi)
        @if($notifiu->notifi_id == $notifi->id)
        <a href="{{ route('read-notifi-cus', $notifi->id)}}"><div class="row">
            <div class="col-md-12">
                <div class="notifi wow fadeInRight">
                    <div class="notifi-header">
                        <h4>{{ $notifi->title }}</h4>
                    </div>
                    <div class="notifi-content">
                        <p class="notifi-title">Bấm vào thông báo để xem nội dung</p>
                        <p class="read">
                            @php
                            echo \Carbon\Carbon::createFromTimeStamp(strtotime($notifiu["created_at"]))->diffForHumans();
                            if($notifiu->read == 0){
                                echo "&nbsp Chưa xem";
                            }
                            else echo "&nbsp Đã xem";
                        @endphp
                        </p>
                    </div>
                </div>
            </div>
        </div></a>
        @endif
    @endforeach
@endforeach

<style>
    .notifi{
        position: relative;
        width: 70%;
        left: 15%;
        height: 130px;
        margin: 20px;
        background-color: #343a40;
        color: white;
        border-radius: 5px;
        overflow: hidden;
        cursor: pointer;
        transition: 0.2s;
    }

    .notifi-header{
        z-index: 3;
        position: absolute;
        left: 0%;
        top: 0%;
        width: 100%;
        height: 50px;
        background-color: white;
        color: #343a40;
        padding: 7px;
        padding-left: 15px;
        
    }

    .notifi-content{
        position: absolute;
        left: 0%;
        bottom: 0%;
        width: 100%;
        height: 80px;
        
    }

    .notifi-title{
        position: absolute;
        left: 0%;
        top: 0%;
        width: 80%;
        height: 100%;
        padding: 20px 0px 0px 15px;
    }

    .read{
        position: absolute;
        right: 0%;
        top: 0%;
        width: 20%;
        height: 100%;
        padding: 20px 0px 0px 5px;
    }

    .notifi:hover{
        transform: scale(1.01);
    }
</style>
@endsection