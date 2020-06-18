<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin home</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    

<link rel="stylesheet" href="{{ asset("/css/admin.css")}}">
</head>
<body>
    <div class="header">
		<div class="canggiua">
			<div class="trai">
            <img class="img_logo" src="{{ asset('images/logo-vcn.png')}}" alt="">
				<a class="logo" href="#">VCN Homes</a>
            </div>
            <div class="date">
                Tháng {{$calendar->month}} Năm {{$calendar->year}}
            </div>
		</div>
    </div>
    <div class="ad">
        <div class="ad-part-left">
            <ul>
                <li id="li1">Admin</li>
                <a href="{{ route('admin.customers.index')}}"><li id="li2">Chủ hộ</li></a>
                <a href="{{ route('admin.bills.index')}}"><li id="li3">Thanh Toán Dịch Vụ</li></a>
                <a href="{{ route('admin.notifications.index')}}"><li id="li4">Thông Báo</li></a>
                <a href="{{ route('admin.statisticals.index')}}"><li id="li5">Thống kê</li></a>
                <a href="{{ route('admin.comment-list')}}"><li id="li5">Bình luận</li></a>
                {{-- <li id="li7">Chức Năng Khác</li> --}}
            </ul>
        </div>
        <div class="ad-part-right">
            <div class="ad-menu-right">
                <ul>
                    <li id="li8">Welcome</li>
                    <a href="{{ route('admin.list-messages')}}"><li id="li9">Tin nhắn</li></a>
                    <a href="{{ route('admin.get-setting')}}"><li id="li10">Cài đặt</li></a>
                    
                        <a href="{{ route('logout') }}"
									onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                    <li id="li11" style="padding: 0px">
                                    <button type="submit" class="nutdangxuat">Đăng xuất</button>
                    </li>
			            </a>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				@csrf
			</form>
                </ul>
            </div>
            <div class="ad-part-content">
                @include('inc.messages')

                @yield('content')
            </div>
        </div>
    </div>
</body> 
<style>
    .ad-part-left a{
        text-decoration: none;
    }
    .date{
        position: absolute;
        right: 20px;
    }
</style>

<script>
    jQuery(document).ready(function($) {
        $(window).scroll(function(event) {
            var vitri = $(window).scrollTop();
            if( vitri >= 80){
                $('.header').css({'top':'-80px'});
                $('.ad-menu-right').css({'position':'fixed', 'top':'0px', 'left': '20%' });
                $('.ad-menu-right li').css({'width':'20%' });
            }
            else{
                $('.header').css({'top':'0px'});
                $('.ad-menu-right').css({'top':'80px'});
            }
    });
    });
</script>
</html>
