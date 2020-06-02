<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="{{ asset("/css/animate.css")}}">
	<script src="{{ asset("/js/wow.min.js")}}"></script>
	<script src="js/wow.min.js"></script>
              <script>
              new WOW().init();
              </script>
</head>
<body>
    <div class="row">
        <div class="col-md-12">
            <div class="header">
                <div class="canggiua">
                    <div class="trai">
                    <img class="img_logo" src="{{ asset('images/logo-vcn.png')}}" alt="">
                        <a class="logo" href="#"></a>
                        <h4 class="v wow bounceIn" data-wow-duration="3s" data-wow-iteration="100">V</h4>
						<h4 class="c wow bounceIn" data-wow-duration="3s" data-wow-iteration="100">C</h4>
					    <h4 class="n wow bounceIn" data-wow-duration="3s" data-wow-iteration="100">N</h4>
                    </div>
                    <div class="phai">
                        <div class="welcome">
                            <h4><b>Chào: </b>{{ Auth::user()->name }}</h4>
                        </div>
                        <div class="status">
                        <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                <button type="submit" class="btn nutdangxuat"><b>Đăng xuất</b></button>
                        </a>
                            
            
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="customer">
        <div class="row">
            <div class="col-md-12">
                <div class="anhnen">
					
				</div>
                <div class="banner">
                    <img src="{{ asset('/images/family2.png')}}" alt="">
                </div>
                <div class="menu-sub">
                    <ul>
                        <a href="{{route('show-info-cus', Auth::user()->id)}}"><li id="li1" style="margin-right: 2%; margin-left: 1%">Hồ sơ khách hàng</li></a>
                        <a href="{{route('show-bill-cus', Auth::user()->id)}}"><li id="li2" style="margin-right: 2%">Tiền dịch vụ</li></a>
                        <a href=""><li id="li3" style="margin-right: 2%">Lịch sử nộp tiền</li></a>
                        <a href="{{route('list-mes-cus', Auth::user()->id)}}"><li id="li4" style="margin-right: 2%">Tin nhắn</li></a>
                        <a href="{{route('list-notifi-cus', Auth::user()->id)}}"><li id="li5" style="margin-right: 1%">Thông báo</li></a>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="main">
                    <div class="info wow bounceInUp">
                        <div class="info-title">
                            <h3>Thông tin khách hàng</h3>
                        </div>
                        <div class="info-content">
                            <p>Mã khách hàng: {{Auth::user()->id}}</p>
                            <p>Họ tên: {{ Auth::user()->name }}</p>   
                            <p>SĐT: {{ Auth::user()->phone }}</p>
                            <p>Email: {{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div class="content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<style>

    *{
        margin: 0;
        padding: 0;
    }

    

    .nutdangxuat{
			background-color: #343a40;
			color: white;
			transition: 0.5s;
		}
    .nutdangxuat:hover{
        background-color: white;
        color: #007bff;
        box-shadow: 0 4px 8px 0 rgba(0, 255, 255, 1), 0 6px 20px 0 rgba(0, 255, 255, 1);
    }
    .content{
        position: absolute;
        width: 75%;
        right: 0%;
        top: 0%;
    }
    .phai{
			position: relative;
			width: 50%;
			height: 100%;
			float: right;
		}
    
    .welcome{
			position: absolute;
			width: 40%;
			right: 20%;
			height: 100%;
			padding: 20px;
		}
		.status{
			position: absolute;
			width: 20%;
			right: 0%;
			height: 100%;
			padding: 16px;
		}

		.v{
			position: absolute;
            top: 10px;
            text-shadow: 1px 1px 5px rgba(0, 255, 255, 1);
			left: 100px;
			font-size: 50px;
			font-weight: bold;
			font-family: 'Kaushan Script', cursive;
			animation-delay: 0.2s
		}
		.c{
			position: absolute;
            top: 10px;
            text-shadow: 1px 1px 5px rgba(0, 255, 255, 1);
			left: 135px;
			font-size: 50px;
			font-weight: bold;
			font-family: 'Kaushan Script', cursive;
			animation-delay: 0.3s
		}
		.n{
			position: absolute;
            top: 10px;
            text-shadow: 1px 1px 5px rgba(0, 255, 255, 1);
			left: 176px;
			font-size: 50px;
			font-weight: bold;
			font-family: 'Kaushan Script', cursive;
			animation-delay: 0.4s
		}
    



    .main{
        position: absolute;
        top:420px;
        left: 10%;
        width: 80%;
    }

    .info{
        position: absolute;
        width: 25%;
        height: 400px;
        border: 1px solid white;
        background-color: #343a40;
        color: white;
        left: 0%;
        top: 0%;
        border-radius: 5px;
        padding: 12px;
        padding-top: 30px;
        font-size: 20px;
    }

    .header{
			width: 100%;
			height: 90px;
			position: fixed;
			top: 0px;
			z-index: 10;
			padding: 10px;
			
			background-color: -webkit-linear-gradient(top right, #00d8c2, #0068b7);
            background-image: -webkit-linear-gradient(right top, rgb(0, 216, 194), rgb(0, 104, 183));
			color: white;
			transition: 0.5s;
		}
		.canggiua{
			width: 100%;
			height: 100%;
			margin: auto;
		}
		.trai{
			width: 50%;
			height: 100%;
			float: left;
		}
		.trai a.logo{
			font-family: 'Kaushan Script', cursive;
			font-size: 30px;
			font-weight: bold;
			text-decoration: none;
			display: block;
			padding: 20px 0 0 0;
			transition: 0.5s;
			float: left;
		}

		.trai img.img_logo{
			float: left;
			width: 70px;
			height: 60px;
			margin: 10px;
			transition: 0.5s;
		}
		
    .customer{
        position: absolute;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 2000px;
    }

    .anhnen{
        position: absolute;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 4000px;
        background-image: url("{{ asset('images/customer.jpg')}}");
        background-attachment: fixed;
        background-size: cover;
		}

    .banner{
        position: absolute;
        top: 80px;
        left: 10%;
        margin: auto;
        width: 80%;
        height: 300px;
        background-image: 
    }

    .banner img{
        position: absolute;
        width: 100%;
        height: 100%;
    }

    .menu-sub{
        position: absolute;
        left: 10%;
        top:330px;
        width: 80%;
        height: 50px;
        overflow: hidden;
        /* transition: 0.5s; */
        z-index: 5;
    }

    .menu-sub li{
        width: 18%;
        height: 50px;
        list-style: none;
        font-weight: bold;
        font-family: 'Kaushan Script', cursive;
        font-size: 20px;
        padding-top: 8px;
        background-color: rgba(0, 255, 255, 1);
        
        text-align: center;
        color: #343a40;
        cursor: pointer;
        float: left;
        border-radius: 5px 5px 0px 0px;
        transition: 0.5s;
    }

    #li1:hover {
        font-size: 21px;
        color: white;
        background-color: #007bff;
        
    }
    #li2:hover {
        font-size: 21px;
        color: white;
        background-color: #007bff;
        
    }
    #li3:hover {
        font-size: 21px;
        color: white;
        background-color: #007bff;
        
    }
    #li4:hover {
        font-size: 21px;
        color: white;
        background-color: #007bff;
        
    }
    #li5:hover {
        font-size: 21px;
        color: white;
        background-color: #007bff;
        
    }

    .menu-sub.ghim{
        position: fixed;
        top: 90px;
        left: 10%;
        margin: auto;
        width: 80%;
        height: 50px;
        transform: scaleX(0.9);
    }

    .menu-sub.ghim li{
        border-radius: 0px 0px 5px 5px;
        background-color: rgba(128, 128, 128, 0.5);
        color: white;
        font-weight: bold;
    }
</style>

<script>
    jQuery(document).ready(function($) {
        $(window).scroll(function(event) {
            var vitri = $(window).scrollTop();
            if( vitri >= 280){
                $('.menu-sub').addClass('ghim');
            }
            else $('.menu-sub').removeClass('ghim');
            
    });
    });
</script>
</html>