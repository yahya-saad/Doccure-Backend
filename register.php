<?php
ob_start();
include ("conn.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$encpass = sha1($password);
	
	$chkEmailExist=$conn->query("SELECT email FROM patients WHERE email='$email' UNION SELECT email FROM doctors WHERE email='$email' ");

	if(empty($name) || empty($email) || empty($password)){
		$_SESSION['errmsg']= "PLEASE FILL ALL FIELDS FRIST";
	}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$_SESSION['errmsg'] = "Invalid Email Address";	
	}elseif($chkEmailExist->num_rows >0){
		$_SESSION['errmsg']= "Email address is already used!";
	}

	// Password Checking 
	elseif (strlen($password) < 6 || strlen($password) > 16) {
		$_SESSION['errmsg'] = "Password should be min 6 characters and max 16 characters";
	}
	elseif (!preg_match("/\d/", $password)) {
		$_SESSION['errmsg'] = "Password should contain at least one digit";
	}
	elseif (!preg_match("/[A-Z]/", $password)) {
		$_SESSION['errmsg'] = "Password should contain at least one Capital Letter";
	}
	elseif (!preg_match("/[a-z]/", $password)) {
		$_SESSION['errmsg'] = "Password should contain at least one small Letter";
	}
	elseif (!preg_match("/\W/", $password)) {
		$_SESSION['errmsg'] = "Password should contain at least one special character";
	}
	elseif (preg_match("/\s/", $password)) {
		$_SESSION['errmsg'] = "Password should not contain any white space";
	}


	else{
	$insertPatient = "INSERT INTO `patients`(`fName`,`email`, `password`) VALUES ('$name', '$email', '$encpass')  ";
	$insert = $conn -> query($insertPatient);
	if($insert) $_SESSION['succmsg'] = "You have registered successfully";
	}
	
}
?>


<!DOCTYPE html> 
<html lang="en">
	
<head>
		<meta charset="utf-8">
		<title>Doccure</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		
		<!-- Favicons -->
		<link href="assets/img/favicon.png" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">

	
	</head>
	<body class="account-page">

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			
			<!-- Header -->
			<?php include("header.php") ?>

			<!-- /Header -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
					
					<div class="row">
						<div class="col-md-8 offset-md-2">
								
							<!-- Register Content -->
							<div class="account-content">
								<div class="row align-items-center justify-content-center">
									<div class="col-md-7 col-lg-6 login-left">
										<img src="assets/img/login-banner.png" class="img-fluid" alt="Doccure Register">	
									</div>
									<div class="col-md-12 col-lg-6 login-right">
										
										<div class="login-header">
											<h3>Patient Register <a href="doctor-register.php">Are you a Doctor?</a></h3>
										</div>

<?php

if(isset($_SESSION['succmsg'])){
	echo "<div class='alert alert-success' role='alert'>";
	echo $_SESSION['succmsg'];
	echo "</div>";
	unset($_SESSION['succmsg']);
	header("Refresh:1");

}
if(isset($_SESSION['errmsg'])){
		echo "<div class='alert alert-danger' role='alert'>";
		echo $_SESSION['errmsg'];
		echo "</div>";						
	unset($_SESSION['errmsg']);
	header("Refresh:1");

}
?>

										<!-- Register Form -->
										<form action="register.php" method="POST">
											<div class="form-group form-focus">
												<input type="text" class="form-control floating" name="name">
												<label class="focus-label">Name</label>
											</div>
											<div class="form-group form-focus">
												<input type="email" class="form-control floating" name="email">
												<label class="focus-label">Email Address</label>
											</div>
											<div class="form-group form-focus">
												<input type="password" class="form-control floating" name="password">
												<label class="focus-label" title="title">Create Password</label>

											<!-- Toggle box for passwordrules -->
											<div id="password-rules">
												<p>
												 <a  data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
												 <i class="fas fa-info-circle mt-3" data-toggle="tooltip" title="" data-original-title=""></i> Password Rules
												</a>
												</p>
												<div class="collapse " id="collapseExample">
												<div class="card card-body text-white bg-dark  p-2">
														<ul class="list-unstyled" >
															<li>- Min length 8 characters and Max length 16.</li>
															<li>- At least one uppercase.</li>
															<li>- At least one lowercase.</li>
															<li>- At least one special character.</li>
															<li>- No white spaces.</li>
														</ul>
													</div>
												</div>
											</div>
											</div>
										

											<div class="text-right">
												<a class="forgot-link" href="login.php">Already have an account?</a>
											</div>
											<button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Signup</button>
										</form>
										
										<!-- /Register Form -->
										
									</div>
								</div>
							</div>
							<!-- /Register Content -->
								
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->
   
			
		   
		</div>
		<!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="assets/js/jquery.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

</html>
<?php
ob_end_flush();
?>