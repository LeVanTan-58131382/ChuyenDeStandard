<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="jquery-3.4.1.js"></script>
	<script src="jquery-3.4.1.min.js"></script>
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
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
		}

		.noidung{
			position: fixed;
			width: 40%;
			background-color: rgba(0, 160, 255, 0.7);
			top: 25%;
			left: 30%;
			border-radius: 15px;
			overflow: hidden;
			z-index: 2;
			padding: 20px;

			visibility: hidden;
			opacity: 0;
			/*hiệu ứng*/
			transition: 0.6s;
			transform: scale(0);
		}

		.noidung h3, .noidung h4{
			color: #343a40;
			text-shadow: 1px 1px 5px rgba(0, 255, 255, 1);
		}

		.noidung.noidunghienra{
			visibility: visible;
			opacity: 1;
			transition: 0.6s;
			transform: scale(1);
		}

		.noidung h3{
			text-align: center;
			padding: 10px 0px;
		}

		.noidung .text{
			padding: 10px 10px;
		}

		.momo{
			width: 100%;
			height: 100%;
			top: 0px;
			position: fixed;
			background-color: rgba(0, 0, 0, 0.5);
			z-index: 1;

			visibility: hidden; /*Vì nếu chỉ cho opacity = 0 thì nó chỉ tàng hình thôi chứ thật ra nó vẫn ở đó, thêm thuộc tính này nó sẽ thật sự biến mất*/
			opacity: 0;
			transition: 0.3s;
			transform: scale(0);
		}

		.momo.momohienra{
			visibility: visible;
			opacity: 1;
			transition: 0.3s;
			transform: scale(1);
		}

		.banner{
			position: relative;
			width: 100%;
			height: 700px;
			top: 0%;
			left: 0%;
		}

		.banner .anhnen{
			position: absolute;
			top: 0%;
			left: 0%;
			width: 100%;
			height: 100%;
		}

		.anhnen img{
			position: absolute;
			top: 0%;
			left: 0%;
			width: 100%;
			height: 100%;
		}

		.header{
			width: 100%;
			height: 100px;
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
		.phai{
			position: relative;
			width: 50%;
			height: 100%;
			float: right;
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
		
		.nutdangnhap{
			margin: auto;
		}

		.welcome{
			position: absolute;
			width: 40%;
			left: 0%;
			height: 100%;
			padding: 20px;
		}
		.gotocutomerpage{
			position: absolute;
			width: 40%;
			right: 20%;
			height: 100%;
			padding: 16px;
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
			color: white;
			text-shadow: 1px 1px 5px rgba(0, 255, 255, 1);
			top: 10px;
			left: 100px;
			font-size: 50px;
			font-weight: bold;
			font-family: 'Kaushan Script', cursive;
			animation-delay: 0.2s
		}
		.c{
			position: absolute;
			color: white;
			text-shadow: 1px 1px 5px rgba(0, 255, 255, 1);
			top: 10px;
			left: 135px;
			font-size: 50px;
			font-weight: bold;
			font-family: 'Kaushan Script', cursive;
			animation-delay: 0.3s
		}
		.n{
			position: absolute;
			color: white;
			text-shadow: 1px 1px 5px rgba(0, 255, 255, 1);
			top: 10px;
			left: 176px;
			font-size: 50px;
			font-weight: bold;
			font-family: 'Kaushan Script', cursive;
			animation-delay: 0.4s
		}
		.nutdangnhap, .nutdangxuat, .goto{
			background-color: #343a40;
			color: white;
			transition: 0.5s;
		}
		.nutdangnhap:hover, .nutdangxuat:hover, .goto:hover{
			background-color: white;
			color: #007bff;
			box-shadow: 0 4px 8px 0 rgba(0, 255, 255, 1), 0 6px 20px 0 rgba(0, 255, 255, 1);
		}
	</style>	
</head>
<body>
<div class="body">
	<div class="row">
		<div class="col-md-12">
			<div class="banner">
				<div class="anhnen">
					<img class="img_logo" src="{{ asset('images/nen.jpg')}}" alt="">
				</div>
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
			@if(Auth::user())
			<div class="welcome">
				<h4><b>Chào: </b>{{ Auth::user()->name }}</h4>
			</div>
			<div class="gotocutomerpage">
			@if(Auth::id() == 1)
				<a href="{{ route('admin-page')}}"><button class="btn goto"><b>Đến trang admin</b></button></a>
			@elseif(Auth::id() != 99999)
				<a href="{{ route('customer-page')}}"><button class="btn goto"><b>Đến trang khách hàng</b></button></a>
			@endif
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
			@endif
			@if(!Auth::user())
			<div class="status">
			<button class="btn nutdangnhap wow wobble" data-wow-duration="1s">Đăng nhập</button>
			</div>
			@endif
		</div>
		</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="momo"></div>
	<div class="noidung">
		<h3>Đăng nhập</h3>
		<form method="POST" action="{{ route('login') }}">
			@csrf

			<div class="form-group row">
				<label for="email" class="col-md-4 col-form-label text-md-right"><h4>Email</h4></label>

				<div class="col-md-6">
					<input style="width: 300px; height: 40px" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

					@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<label for="password" class="col-md-4 col-form-label text-md-right"><h4>Mật khẩu</h4></label>

				<div class="col-md-6">
					<input style="width: 300px; height: 40px" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
					@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>

			<div class="form-group row">
				<div class="col-md-6 offset-md-4">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

						<label class="form-check-label" for="remember">
							{{ __('Remember Me') }}
						</label>
					</div>
				</div>
			</div>
			<div class="form-group row mb-0">
				<div class="col-md-8 offset-md-4">
					<button type="submit" class="btn btn-primary nutdangnhap">
						Đăng nhập
					</button>
					@if (Route::has('password.request'))
						<a style="color: white" class="btn btn-link" href="{{ route('password.request') }}">
							Quên mật khẩu?
						</a>
					@endif
				</div>
			</div>
		</form>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="content">

			</div>
		</div>
	</div>
	
</div>
	<script>
		jQuery(document).ready(function($) {
			// nút mở
			$('.nutdangnhap').click(function(event) {
				$('.noidung').addClass('noidunghienra');
				$('.momo').addClass('momohienra');
			});
			//nút đóng
			$('.nutdong').click(function(event) {
				$('.noidung').removeClass('noidunghienra');
				$('.momo').removeClass('momohienra');
			});
			// khi kích vào khoảng trống (div mờ mờ) thì cũng đóng lun
			$('.momo').click(function(event) {
				$('.noidung').removeClass('noidunghienra');
				$('.momo').removeClass('momohienra');
			});
			// hoặc có thể viết theo cách này
			// $('.nutdong, momo').click(function(event) {
			// 	$('.noidung').removeClass('noidunghienra');
			// 	$('.momo').removeClass('momohienra');
			// });
		});
	</script>
</body>
</html>