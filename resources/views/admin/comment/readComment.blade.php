@extends('admin.home')

@section('content')
<div class="read">
    @if ($customer)
        Người bình luận: {{ $customer->name }}
        <br>
        Email: {{ $customer->email }}
        <br>
        <hr>
        Tiêu đề: {{ $comment->title }}
        <hr>
        Nội dung:
        <br><br>
        {{$comment->content }}
        <hr>
        <a href="{{ route('admin.show-bill-detail', [1 , $idBillE ])}}">Xem Hóa đơn Tiền điện của khách hàng</a>
        <hr>
        <a href="{{ route('admin.show-bill-detail', [2 , $idBillW ])}}">Xem Hóa đơn Tiền nước của khách hàng</a>
        <hr>
        @if($comment->customer_id != 1)
            <a href="{{ route('admin.comment-create', $comment->id) }}" class="btn btn-primary">Trả lời</a>
        @endif
        
        <a href="{{ route('admin.comment-delete', $comment->id) }}" class="btn btn-danger float-right">Xóa</a>
        <br><br>
    @endif
    @if(!$customer)
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
