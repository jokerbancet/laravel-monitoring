<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Aplikasi Monitoring Magang Mahasiswa | PEP Bandung</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{asset('admin/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin/assets/vendor/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin/assets/vendor/linearicons/style.css')}}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{asset('admin/assets/css/main.css')}}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{asset('admin/assets/css/demo.css')}}">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="">
	<link rel="icon" type="image/png" sizes="96x96" href="{{asset('admin/assets/img/logo-transparent.png')}}">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<div class="logo text-center"><img src="{{asset('admin/assets/img/logo/logo-utama-warna.png')}}" alt="pep Logo" width="60%"></div>
							</div>
							<form class="form-auth-small" action="" method="post">
                                @csrf
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Email</label>
									<input name="email" type="email" class="form-control" id="signin-email"  placeholder="Email">
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block">SEND EMAIL</button>
								<div class="bottom">
									<span class="helper-text"><i class="fa fa-home"></i> <a href="/login">Kembali</a></span>
								</div>
                                @if (session()->has('failed'))
                                    <span class="text-danger">{{session('failed')}}</span>
                                @endif
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Aplikasi Monitoring Magang Mahasiswa</h1>
							<p>by PEP Bandung</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
