
<!DOCTYPE html>
<html dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
	<title><?php echo $title ?></title>
	<!-- Custom CSS -->
	<link href="<?php echo site_url() ?>assets/css/style.min.css" rel="stylesheet">

</head>

<body style="background-color: #eef5f9">
	<div class="main-wrapper">
		
		<div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
			<div class="auth-box">
				<div id="loginform">
					<div class="logo">
						<span class="db"><img src="<?php echo site_url() ?>assets/images/logo-safira-full.png" alt="logo" height="100" /></span>
					</div>
					<!-- Form -->
					<div class="row">
						<div class="col-12">
							<form class="form-horizontal m-t-20" action="<?php echo site_url('auth/login') ?>" method="post">
								<?php echo validation_errors(); ?>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
									</div>
									<input autofocus type="text" name="username" class="form-control form-control-lg" placeholder="Username" value="<?php echo set_value('username') ?>">
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
									</div>
									<input type="password" name="password" class="form-control form-control-lg" placeholder="Password">
								</div>
								<div class="form-group text-center">
									<div class="col-xs-12 p-b-20">
										<button class="btn btn-block btn-lg btn-dark" type="submit">Login</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?php echo site_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap tether Core JavaScript -->
	<script src="<?php echo site_url() ?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
	<script src="<?php echo site_url() ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>