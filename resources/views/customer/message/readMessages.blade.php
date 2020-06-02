@extends('customer.home')

@section('content')
<div class="read wow fadeInRight">
    Người gửi: {{ $message->userFrom->name }}
    <br>
    Email: {{ $message->userFrom->email }}
    <br>
    <hr>
    Tiêu đề: {{ $message->title }}
    <hr>
    Nội dung:
    <br><br>
    {{$message->content }}
    <hr>
    @if($message->user_id_from == 1)
    <a href="{{ route('create-mes-cus', [$message->userFrom->id, $message->title]) }}" class="btn btn-primary">Trả lời</a>
    @endif
    
    <a href="{{ route('destroy-mes-cus', $message->id) }}" class="btn btn-danger float-right">Xóa</a>
    <br><br>
</div>
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
