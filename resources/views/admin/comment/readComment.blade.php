@extends('admin.home')

@section('content')
<div class="read">
    @if ($user)
        Người bình luận: {{ $user->name }}
        <br>
        Email: {{ $user->email }}
        <br>
        <hr>
        Tiêu đề: {{ $comment->title }}
        <hr>
        Nội dung:
        <br><br>
        {{$comment->content }}
        <hr>
        <a href="{{ route('show-Bill', $user -> id)}}">Xem Hóa đơn của khách hàng</a>
        <hr>
        @if($comment->user_id != 1)
            <a href="{{ route('create-cmt-ad', $comment->id) }}" class="btn btn-primary">Trả lời</a>
        @endif
        
        <a href="{{ route('destroy-cmt-ad', $comment->id) }}" class="btn btn-danger float-right">Xóa</a>
        <br><br>
    @endif
    @if(!$user)
        Người bình luận: Quản trị viên
        <br>
        <hr>
        Tiêu đề: {{ $comment->title }}
        <hr>
        Nội dung:
        <br><br>
        {{$comment->content }}
        <hr>
        <a href="{{ route('destroy-cmt-ad', $comment->id) }}" class="btn btn-danger float-right">Xóa</a>
        <br><br>
    @endif
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
