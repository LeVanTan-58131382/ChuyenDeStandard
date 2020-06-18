@extends('admin.home')

@section('content')
<div class="read">
    Người gửi: 
    @if($message->user_id_from > 1)
    <b>
    {{ $message->userFrom->name }}

     - Email: {{ $message->userFrom->email }}</b>
    @elseif($message->user_id_from == 1)
    <b>Quản trị viên</b>   
    @endif
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspNgười nhận:
    @if($message->user_id_to > 1)
    <b>
    {{ $message->userTo->name }}
    
     - Email: {{ $message->userTo->email }}</b>
    @elseif($message->user_id_to == 1)
    <b>Quản trị viên</b>   
    @endif
    <br>
    <hr>
    Tiêu đề: {{ $message->title }}
    <hr>
    Nội dung:
    <br><br> 
    {{$message->content }}
    <hr>
    @if($message->user_id_from != 1)
    <a href="{{ route('admin.create-messages', [$message->userFrom->id, $message->title]) }}" class="btn btn-primary">Trả lời</a>
    @endif
    
    <a href="{{ route('admin.destroy-messages', $message->id) }}" class="btn btn-danger float-right">Xóa</a>
    <br><br>
</div>
<style>
    .read{
        position: relative;
        left: 0%;
        top: 0%;
        width: 100%;
        height: 100%;
        border: 1px solid black;
        border-radius: 5px;
        padding: 30px;
    }
</style>
@endsection
