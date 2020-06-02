@extends('admin.home')

@section('content')
<div class="create-mes">
    <h3>Tạo comment trả lời</h3>
    <form action="{{ route('send-cmt-ad', $comment->id)}}" method="post">
      @csrf
        <div class="form-group">
            <label for="">Tiêu đề comment:</label>
          <input type="text" class="form-control" value="{{$titleNew}}" name="title">
          </div>
        <div class="form-group">
          <label for="email">Nội dung trả lời:</label>
          <textarea class="form-control" id="" rows="3" name="content"></textarea>
        </div>
        <br><br>
    <button type="submit" class="btn btn-primary">Gửi câu trả lời</button>
  </form>
</div>
<style>
    .create-mes{
        position: relative;
        left: 0%;
        top: 0%;
        width: 100%;
        height: 500px;
        border: 1px solid black;
        border-radius: 5px;
        padding: 30px;
    }
    .create-mes select{
        width: 250px;
        height: 35px;
        border-radius: 4px;
    }
</style>
@endsection