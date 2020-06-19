@extends('customer.home')

@section('content')
<div class="create-mes wow fadeInRight">
    <h3>Tạo tin nhắn</h3>
    <form action="{{ route('customer.send-messages')}}" method="post">
      @csrf
        <div class="form-group">
            <label for="">Tiêu đề tin nhắn:</label>
            <input type="text" class="form-control" value="{{ $title}}"  name="title">
          </div>
        <div class="form-group">
          <label for="email">Nội dung tin nhắn:</label>
          <textarea class="form-control" id="" rows="3" name="content"></textarea>
        </div>
        <br><br>
    <button id="nutgui" type="submit" class="btn btn-light">Gửi tin nhắn</button>
  </form>
</div>
<style>
    .create-mes{
        position: relative;
        left: 0%;
        top: 0%;
        width: 100%;
        height: auto;
        background-color: #007bff;
        border: 1px solid white;
        color: white;
        border-radius: 5px;
        padding: 30px;
        margin: 20px;
        margin-top: 0px;
    }
    .create-mes select{
        width: 250px;
        height: 35px;
        border-radius: 4px;
    }
    #nutgui:hover{ 
        box-shadow: 0 4px 8px 0 rgba(0, 255, 255, 0.8), 0 6px 20px 0 rgba(0, 255, 255, 0.8);
    }
</style>
@endsection