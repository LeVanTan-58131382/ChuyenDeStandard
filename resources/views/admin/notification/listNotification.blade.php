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
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($notifications as $notifi)
                    <tr>
                        <th scope="row">{{$notifi->id}}</th>
                        <td>{{$notifi->title}}</td>
                        <td>{{\Carbon\Carbon::createFromTimeStamp(strtotime($notifi["created_at"]))->diffForHumans()}}</td>
                        <td>
                            <?php
                                if($notifi -> scope == 99999){
                                    echo 'Tất cả Chủ hộ';
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
                        <td><a href="{{ route('admin.notifications.show', $notifi->id)}}">Chi tiết</a></td>
                        <td>
                            <i style='cursor:pointer' class="fas fa-trash-alt" data-toggle="modal"
                          data-target="#exampleModal{{$notifi->id}}" ></i>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$notifi->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                      Bạn có muốn xóa thông báo này ?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    <form method="post" action="notifications/{{ $notifi->id }}">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger">Xóa</button>
                                  </form>
                                    {{-- <a href="{{route('destroy-cus', $customer -> id)}}"><button type="button" class="btn btn-primary">Xóa</button></a> --}}
                                  </div>
                                </div>
                              </div>
                            </div>
                      </td>
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