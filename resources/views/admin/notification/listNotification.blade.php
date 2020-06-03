@extends('admin.home')

@section('content')
<div class="list-notifi">
    <h3 style="text-align: center">Danh sách thông báo</h3>
    <a class="btn btn-dark" href="{{ route('admin.notifications.create')}}">Tạo thông báo mới</a>
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
                                if($notifi -> scope == 99999){
                                    echo 'Tất cả khách hàng';
                                }
                                else{
                                    foreach ($notificationCustomer as $notifiCustomer){
                                        foreach ($customers as $customer) {
                                            if($notifiCustomer->notification_id == $notifi -> id && $notifiCustomer -> customer_id == $customer->id)
                                            {
                                                echo $customer->name;
                                            }
                                        }
                                    }
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                                if($notifi -> scope == 1){
                                    foreach ($notificationCustomer as $notifiCustomer){
                                        if($notifiCustomer->notification_id == $notifi -> id && $notifiCustomer->read == 0)
                                            { 
                                                echo "Chưa xem";
                                            }
                                        
                                        elseif($notifiCustomer->notification_id == $notifi -> id && $notifiCustomer->read == 1)
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