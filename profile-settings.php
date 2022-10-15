<?php
ob_start();
session_start();
include("conn.php");
if(!isset($_SESSION['patientLogin'])){
	$_SESSION['loginMsg'] = 'You must log in frist!';
	header("Location:login.php");
}else{
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
		
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
		
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
									<li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Profile Settings</h2>
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
						<!-- /Profile Sidebar -->
						
						<div class="col-md-7 col-lg-8 col-xl-9">
							<div class="card">
								<div class="card-body">
									<?php
								if(isset($_SESSION['succmsg'])){
											echo "<div class='alert alert-success' role='alert'>";
											echo $_SESSION['succmsg'];
											echo "</div>";
											unset($_SESSION['succmsg']);
											header("Refresh:1.5");
										}
										if(isset($_SESSION['errmsg'])){
												echo "<div class='alert alert-danger' role='alert'>";
												echo $_SESSION['errmsg'];
												echo "</div>";						
											unset($_SESSION['errmsg']);
											header("Refresh:1.5");
										}
										?>
								<?php 
								$id	= $_SESSION['id'];
								$selectPatient = "SELECT * FROM `patients` where id=$id";
								$select = $conn->query($selectPatient);
								foreach($select as $p){
								?>
									<!-- Profile Settings Form -->
									
									<form action="updatePatientProfile.php" method="POST" enctype="multipart/form-data">
										<div class="row form-row">
											<div class="col-12 col-md-12">
												<div class="form-group">
													<div class="change-avatar">
														<div class="profile-img">
															<img src="<?= $p['image'] ?>" alt="User Image">
														</div>
														<div class="upload-img">
															<div class="change-photo-btn">
																<span><i class="fa fa-upload"></i> Upload Photo</span>
																<input type="file" class="upload" name="pimg">
															</div>
															<small class="form-text text-muted">Allowed JPG, PNG. Max size of 2MB</small>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>First Name<span class="text-danger">*</span></label>
													<input type="text" class="form-control" value="<?= $p['fName'] ?>" name="fName">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Last Name<span class="text-danger">*</span></label>
													<input type="text" class="form-control" value="<?= $p['lName'] ?>" name="lName">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Date of Birth<span class="text-danger">*</span></label>
													<div class="cal-icon">
														<input type="text" class="form-control datetimepicker" value="<?= $p['dateOfBirth'] ?>" name="dateOfBirth">
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Blood Group<span class="text-danger">*</span></label>
													<select class="form-control select" name="bloodGroup">
														<option <?php if($p['bloodGroup'] == "A-") echo "selected" ?>>A-</option>
														<option <?php if($p['bloodGroup'] == "A+") echo "selected" ?>>A+</option>
														<option <?php if($p['bloodGroup'] == "B-") echo "selected" ?>>B-</option>
														<option <?php if($p['bloodGroup'] == "B+") echo "selected" ?>>B+</option>
														<option <?php if($p['bloodGroup'] == "AB-") echo "selected" ?>>AB-</option>
														<option <?php if($p['bloodGroup'] == "AB+") echo "selected" ?>>AB+</option>
														<option <?php if($p['bloodGroup'] == "O-") echo "selected" ?>>O-</option>
														<option <?php if($p['bloodGroup'] == "O+") echo "selected" ?>>O+</option>
													</select>
												</div>
											</div>
											
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Phone<span class="text-danger">*</span></label>
													<input type="text" value="<?= $p['phone'] ?>" class="form-control" name="phone">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
												<label>Address</label>
													<input type="text" class="form-control" value="<?= $p['address'] ?>" name="address">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>City</label>
													<input type="text" class="form-control" value="<?= $p['city'] ?>" name="city">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>State</label>
													<input type="text" class="form-control" value="<?= $p['state'] ?>" name="state">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Zip Code</label>
													<input type="text" class="form-control" value="<?= $p['zipCode'] ?>" name="zipCode">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Country</label>
													<input type="text" class="form-control" value="<?= $p['country'] ?>" name="country">
												</div>
											</div>
										</div>
										<div class="submit-section">
											<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
										</div>
									</form>
									<!-- /Profile Settings Form -->
									
									<?php } ?>

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
		
		<!-- Select2 JS -->
		<script src="assets/plugins/select2/js/select2.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		
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