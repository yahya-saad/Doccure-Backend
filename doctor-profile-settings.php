<?php
ob_start();
session_start();
include("conn.php");
if(!isset($_SESSION['doctorLogin'])){
	$_SESSION['loginMsg'] = 'You must log in frist!';
	header("Location:doctorlogin.php");
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
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css">
		
		<link rel="stylesheet" href="assets/plugins/dropzone/dropzone.min.css">
		
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
						<?php include("doctorSlideBar.php") ?>
							<!-- /Profile Sidebar -->
							
						<div class="col-md-7 col-lg-8 col-xl-9">
							<form action="updateDoctorProfile.php" method="POST" enctype="multipart/form-data">						
								<!-- Basic Information -->
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
								$selectDoctor = "SELECT * FROM `doctors` where id=$id";
								$select = $conn->query($selectDoctor);
								foreach($select as $p){
								?>
										<h4 class="card-title">Basic Information</h4>
										<div class="row form-row">
											<div class="col-md-12">
												<div class="form-group">
													<div class="change-avatar">
														<div class="profile-img">
															<img src="<?= $p['image'] ?>" alt="User Image">
														</div>
														<div class="upload-img">
															<div class="change-photo-btn">
																<span><i class="fa fa-upload"></i> Upload Photo</span>
																<input type="file" class="upload" name="dimg">
															</div>
															<small class="form-text text-muted">Allowed JPG, PNG. Max size of 2MB</small>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-6">
		
												<div class="form-group">
													<label>First Name <span class="text-danger">*</span></label>
													<input type="text" class="form-control"  name="fName"  value="<?= $p['fName']?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Last Name <span class="text-danger">*</span></label>
													<input type="text" class="form-control" name="lName" value="<?= $p['lName']?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Phone Number<span class="text-danger">*</span></label>
													<input type="text" class="form-control" name="phone" value="<?= $p['phone']?>">
												</div>
											</div>
											
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">Country</label>
													<input type="text" class="form-control" name="country" value="<?= $p['country']?>">
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">State</label>
													<input type="text" class="form-control" name="state" value="<?= $p['state']?>">
												</div>
											</div>
											
										</div>
									</div>
								</div>
								<!-- /Basic Information -->
								
								<!-- About Me -->
								<div class="card">
									<div class="card-body">
										<h4 class="card-title">About Me</h4>

										<div class="col-md-14">
												<div class="form-group">
													<label class="control-label">Specialization<span class="text-danger">*</span></label>
													<input type="text" class="form-control" name="specialization" value="<?= $p['specialization']?>">
												</div>
											</div>
											
										<div class="form-group mb-4">
											<label>Biography</label>
											<textarea class="form-control" rows="5" name="bio"><?= $p['biography']?></textarea>
										</div>

									
									</div>
								</div>
								<!-- /About Me -->
								
								

								
								
								<!-- Pricing -->
								<div class="card">
									<div class="card-body">
										<h4 class="card-title">Pricing<span class="text-danger">*</span></h4>
										
										<div class="form-group mb-0">
											<div id="pricing_select">
												<input type="text" class="form-control" id="custom_rating_input" name="price"  value="<?= $p['price']?>">
											</div>

										</div>
										
										
										
									</div>
								</div>
								<!-- /Pricing -->
								
								
							
								
								
								<div class="submit-section submit-btn-bottom">
									<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
								</div>
							</form>	
							<?php } ?>
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
		
		<!-- Select2 JS -->
		<script src="assets/plugins/select2/js/select2.min.js"></script>
		
		<!-- Dropzone JS -->
		<script src="assets/plugins/dropzone/dropzone.min.js"></script>
		
		<!-- Bootstrap Tagsinput JS -->
		<script src="assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js"></script>
		
		<!-- Profile Settings JS -->
		<script src="assets/js/profile-settings.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

</html>
<?php 
ob_end_flush();
} ?>