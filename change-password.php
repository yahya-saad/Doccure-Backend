<?php
ob_start();
session_start();
include("conn.php");

if(!isset($_SESSION['patientLogin'])){
	$_SESSION['loginMsg'] = 'You must log in frist!';
	header("Location:login.php");
}else{
	
	if(isset($_POST['submit'])){

		$id=$_SESSION['id'];
		$oldPass = sha1($_POST['oldPass']);
		$nPass = sha1($_POST['nPass']);
		$cPass = sha1($_POST['cPass']);

	

		$selectPassword = "SELECT `password` FROM `patients` WHERE id='$id'";
		$select = $conn -> query($selectPassword);
		foreach($select as $i){
			if($oldPass == $i['password'] && $nPass == $cPass) {
				$_SESSION['succmsg'] = "Password updated successfully";
				$updatePassword = "UPDATE `patients` SET `password` ='$nPass' WHERE id = $id ";
				$update = $conn ->query($updatePassword);
			}
			elseif ($oldPass != $i['password']){$_SESSION['errmsg'] = "Old password is incorrect";}
			elseif ($nPass != $cPass) {$_SESSION['errmsg'] = "new or confirm password doesn't match";}
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
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
				<!-- Header -->
				<?php include("header.php") ?>
				<!-- /Header -->
			
			<!-- Breadcrumb -->
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Change Password</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Change Password</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						
						<!-- Profile Sidebar -->
						<?php include("patientSlideBar.php") ?>

						
						<div class="col-md-7 col-lg-8 col-xl-9">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-md-12 col-lg-6">
											<!-- Change Password Form -->
											<form action="change-password.php" method="POST">
												<div class="form-group">
													<label>Old Password</label>
													<input type="password" class="form-control" name="oldPass">
												</div>
												<div class="form-group">
													<label>New Password</label>
													<input type="password" class="form-control" name="nPass">
												</div>
												<div class="form-group">
													<label>Confirm Password</label>
													<input type="password" class="form-control" name="cPass">
												</div>
												<div class="submit-section">
													<button type="submit" class="btn btn-primary submit-btn mb-4" name="submit">Save Changes</button>
												</div>
											</form>
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
											<!-- /Change Password Form -->
											
										</div>
									</div>
								</div>
							</div>
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
		
		<!-- Sticky Sidebar JS -->
        <script src="assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
        <script src="assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

</html>
<?php
ob_end_flush();
} ?>