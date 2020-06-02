@extends('customer.home')

@section('content')
@foreach ($notificationUser as $notifiu)
        <div class="read wow fadeInRight">
            @foreach ($users as $user)
                @if($notifiu->user_id == $user->id)
                    Người gửi: Quản trị viên
                    {{-- Người nhận: {{ $user->name }} --}}
                    <br>
                    {{-- Email: {{ $user->email }} --}}
                <br>
                @endif
            @endforeach
        <hr>
        Tiêu đề: {{ $notification->title }}
        <hr>
        Nội dung:
        <br><br>
        {{$notification->content }}
        <hr>
        <br><br>
    </div>
@endforeach

<style>
    .read{
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
    }
</style>
@endsection
