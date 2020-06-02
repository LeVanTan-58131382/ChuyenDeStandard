@extends('admin.home')

@section('content')
<div class="create-mes">
    <h3>Tạo tin nhắn</h3>
    <form action="{{ route('send-mes')}}" method="post">
      @csrf
        <div class="form-group">
            <label for="">Tiêu đề tin nhắn:</label>
            <input type="text" class="form-control" value = "{{ $title}}" name="title">
          </div>
        <div class="form-group">
          <label for="email">Nội dung tin nhắn:</label>
          <textarea class="form-control" id="" rows="3" name="content"></textarea>
        </div>
        <div class="form-group">
          <label for="pwd">Người nhận tin nhắn:</label>
          <select style="width: 400px" name="to" id="">
            @foreach($users as $user)
              <option value="{{ $user->id }}">{{ $user->name }}, {{ $user->email }}</option>
            @endforeach
          </select>
        </div>
        <br><br>
    <button type="submit" class="btn btn-primary">Gửi tin nhắn</button>
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