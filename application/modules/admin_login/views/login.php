<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="<?php echo base_url(); ?>assets/fav-icon.png" />
	<title> Karakover </title>
	<!-- Custom fonts for this template-->
	<link href="<?php echo base_url(); ?>assets/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,800;1,100;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">
	<!-- Custom styles for this template-->
	<link href="<?php echo base_url(); ?>assets/css/sb-admin-2.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/new-theme.css" rel="stylesheet">
</head>

<body class="bg-auth">
	<div class="container">
		<!-- Outer Row -->
		<div class="row justify-content-center">
			<div class="col-md-5">
				<div class="col-md-12 mt-5 py-3 text-center rounded">
					<p>
						<img src="<?php echo base_url(); ?>assets/logo.png" alt="" class="img-fluid" width=" ">
					</p>
				</div>
				<div class="card o-hidden border-0 shadow-lg my-3 card-auth">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="col-lg-12">
								<div class="card-auth-inner">
									<div class="text-center">
										<h1 class="h4 page-title mb-4">Welcome To KarakOver!</h1>
									</div>
									<div class="container"> <?php if ($this->session->flashdata('error_msg')) {
																echo '<p class="alert alert-danger">' . $this->session->flashdata('error_msg') . '</p>';
																$this->session->unset_userdata('error_msg');
															}
															?> </div>
									<form class="user" method="post" action="
																							<?= base_url('karakover-admin'); ?>">
										<div class="form-group">
											<input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" value="<?php if (isset($_COOKIE["email"])) {
																																						echo $_COOKIE["email"];
																																					} ?>" aria-describedby="emailHelp" placeholder="Enter Email Address...">
										</div>

										<div class="form-group">
											<label for="userpassword">Password</label>
											<div class="position-relative">
												<input type="password" id="loginpassword" name="password" class="form-control form-control-user" value="<?php if (isset($_COOKIE["password"])) {
																																							echo $_COOKIE["password"];
																																						} ?>" id="exampleInputPassword" placeholder="Password">
												<i class="fa fa-eye-slash toggle-password ct_eye_open" toggle="password-field" aria-hidden="true"></i>
											</div>

										</div>
										<!--    </div> -->
										<div class="form-group">
											<div class="custom-control custom-checkbox small">
												<input type="checkbox" name="remember" <?php if (isset($_COOKIE["email"])) { ?> checked="checked" <?php } ?> class="custom-control-input" id="customCheck">
												<label class="custom-control-label" for="customCheck">Remember Me</label>
											</div>
										</div>
										<input type="submit" class="btn btn-primary btn-user btn-block btn-aa-theme" value="Login">
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Bootstrap core JavaScript-->
	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"> </script>

	<script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"> </script>
	<!-- Core plugin JavaScript-->
	<script src="<?php echo base_url(); ?>assets/js/jquery.easing.min.js"> </script>
	<!-- Custom scripts for all pages-->
	<script src="<?php echo base_url(); ?>assets/js/sb-admin-2.min.js"></script>

	<script type="text/javascript">
		$(".toggle-password").click(function() {
			$(this).toggleClass("fa-eye-slash fa-eye");
			var input = $('#loginpassword');
			if (input.attr("type") == "password") {
				$('body').find('#loginpassword').prop("type", "text");
			} else {
				input.prop("type", "password");
			}
		});
	</script>
</body>

</html>