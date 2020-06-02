@extends('admin.home')

@section('content')
<div class="create-notifi">
    <h3>Tạo thông báo</h3>
<form action="{{ route('send-notifi')}}" method="post">
  @csrf
        <div class="form-group">
            <label>Tiêu đề thông báo:</label>
            <input name="title" type="text" class="form-control" placeholder="Nhập tiêu đề thông báo">
          </div>
        <div class="form-group">
          <label>Nội dung thông báo:</label>
          <textarea class="form-control" name="content" rows="3"></textarea>
        </div>
        <div class="form-group">
          <label>Người nhận thông báo:</label>
          <select name="selectUser">
              <option selected value="99999">Tất cả khách hàng</option>
              @foreach ($users as $user)
                <option value="{{ $user->id}}">{{ $user->name}}</option>
              @endforeach
          </select>
        </div>
        <br><br>
    <button type="submit" class="btn btn-primary">Gửi thông báo</button>
  </form>
</div>
<style>
    .create-notifi{
        position: relative;
        left: 0%;
        top: 0%;
        width: 100%;
        height: 500px;
        border: 1px solid black;
        border-radius: 5px;
        padding: 30px;
    }
    .create-notifi select{
        width: 250px;
        height: 35px;
        border-radius: 4px;
    }
</style>
@endsection