@extends('admin.home')

@section('content')
<div class="list-notifi">
    <h3 style="text-align: center">Danh sách thông báo</h3>
    <a class="btn btn-dark" href="{{ route('create-notifi')}}">Tạo thông báo mới</a>
    <br><br>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Ngày gửi</th>
                    <th scope="col">Người nhận</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($notifications as $notifi)
                    <tr>
                        <th scope="row">1</th>
                        <td>{{$notifi->title}}</td>
                        <td>15/5/2020</td>
                        <td>
                            <?php
                                if($notifi -> scope == 0){
                                    echo 'Tất cả khách hàng';
                                }
                                else{
                                    foreach ($notificationUser as $notifiuser){
                                        foreach ($users as $user) {
                                            if($notifiuser->notifi_id == $notifi -> id && $notifiuser -> user_id == $user->id)
                                            {
                                                echo $user->name;
                                            }
                                        }
                                    }
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                                if($notifi -> scope == 1){
                                    foreach ($notificationUser as $notifiuser){
                                        if($notifiuser->notifi_id == $notifi -> id && $notifiuser->read == 0)
                                            { 
                                                echo "Chưa xem";
                                            }
                                        
                                        elseif($notifiuser->notifi_id == $notifi -> id && $notifiuser->read == 1)
                                        {
                                            echo "Đã xem";
                                        }
                                }
                            }
                            ?>
                        </td>
                        <td><a href="">Chi tiết</a></td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
<style>
    .list-notifi{
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