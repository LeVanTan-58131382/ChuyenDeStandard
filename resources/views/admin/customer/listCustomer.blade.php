@extends('admin.home')

@section('content') 
<div class="list-user">
    <a class="btn btn-dark" href="customers/create">Tạo mới Chủ hộ</a>
    <h3 style="text-align: center">Danh sách Chủ hộ</h3>
    <br>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Mã Chủ hộ</th>
                    <th scope="col">Tên Chủ hộ</th>
                    <th scope="col">Email</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @if (count($customers) > 0)
                        @foreach ($customers as $customer)
                            <tr>
                                <th scope="row">{{ $customer -> id}}</th>
                                <td>{{ $customer -> name}}</td>
                                <td>{{ $customer -> email}}</td>
                                <td>
                                    <?php foreach($apartmentAddress as $apart)
                                        if(($apart -> customer_id) == ($customer -> id))
                                        {
                                           echo 'Căn hộ '.$apart->block.$apart->floor.$apart->apartment;
                                        }
                                    ?>
                                </td>
                                <td>{{ $customer -> phone}}</td>
                              <td><a href="customers/{{$customer -> id}}">Chi tiết</a></td>
                                <td><a href="customers/{{$customer -> id}}/edit">Cập nhật</a></td>
                                <td>
                                      <i style='cursor:pointer' class="fas fa-trash-alt" data-toggle="modal"
                                    data-target="#exampleModal{{$customer -> id}}" ></i>
                                      <!-- Modal -->
                                      <div class="modal fade" id="exampleModal{{$customer -> id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có muốn xóa {{$customer -> name}}
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                              <form method="post" action="customers/{{ $customer->id }}">
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
                    @else
                        <h3>Không có khách hàng nào trong danh sách.</h3>
                    @endif
                </tbody>
              </table>
        </div>
        <div style="position: relative; margin: auto">{{ $customers->links() }}</div>
    </div>
</div>
<style>
    .list-user{
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