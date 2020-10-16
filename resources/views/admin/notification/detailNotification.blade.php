@extends('admin.home')

@section('content')
<div class="detail-notifi">
    <h3 style="text-align: center">Chi tiết thông báo</h3>
    <p>Tiêu đề: {{ $notification->title}}</p>
    <p>Nội dung:{{ $notification->content}}</p>
    <p>Ngày gửi:{{\Carbon\Carbon::createFromTimeStamp(strtotime($notification["created_at"]))->diffForHumans()}}</td></p>
    <p>Người nhận:
        @if($notification->scope == 99999)
        Tất cả chủ hộ
        @elseif($notification->scope == 1)
            @foreach ($notifications as $notifi)
                @foreach ($customers as $customer)
                    @if(($notifi->notification_id == $notification->id) && ($notifi->customer_id == $customer->id ))
                        {{ $customer->name }}
                    @endif
                @endforeach
            @endforeach
        @endif
    </p>
    <p>Trạng thái: 
        @if($notification->read == 1)
        Đã xem
        @elseif($notification->read == 0)
        Chưa xem
        @endif
    </p>
    <br>
    <ul>
        <li>
            <form action="">
                <button class="btn btn-success" type="submit">Xóa</button>
            </form>
        </li>
        <li>
            <form action="">
                <button class="btn btn-success" type="submit">Gửi lại</button>
            </form>
        </li>
    </ul>
    <a style="position: relative; left: 46%;" href="{{ url()->previous() }}" class="btn btn-primary">Quay lại</a>
</div>
<style>
    .detail-notifi{
        position: relative;
        left: 0%;
        top: 0%;
        width: 100%;
        height: 500px;
        border: 1px solid black;
        border-radius: 5px;
        padding: 30px;
    }
    .detail-notifi li{
        list-style: none;
        float: left;
        margin-right: 50px
    }
</style>
@endsection