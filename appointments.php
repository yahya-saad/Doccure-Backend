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
									<li class="breadcrumb-item active" aria-current="page">Appointments</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Appointments</h2>
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
					<?php  include("doctorSlideBar.php") ?>
						<!-- /Profile Sidebar -->
						
						<div class="col-md-7 col-lg-8 col-xl-9">
							<h2 class="text-center my-3">Accepted Appoinments</h2>
							<div class="appointments">
							<?php 

						// Function that convert time from 24H to 12H format
						function convertTime($time){
							if($time > "11:59" && $time < "24:00"){
							echo date("h:i", strtotime($time))." PM";
							}else{
							echo date("h:i", strtotime($time))." AM";
							}
							}

							$docID=$_SESSION['id'];
							$selectApp="SELECT * FROM `appointments` where doctorID=$docID AND status='Confirm' ORDER BY id DESC" ;
							$selectAppRes=$conn->query($selectApp);
							foreach($selectAppRes as $i){
								$patientID=$i['patientID'];
								$selectPatient=" SELECT * FROM `patients` where id=$patientID" ;
								$selectPatientRes=$conn->query($selectPatient);					
								foreach($selectPatientRes as $j){
								?>
								<!-- Appointment List -->
								<div class="appointment-list">
									<div class="profile-info-widget">
										<a href="appointments.php" class="booking-doc-img">
											<img src="<?= $j['image'] ?>" alt="User Image">
										</a>
										<div class="profile-det-info">
											<h3><a href="appointments.php"><?= $j['fName'] . " ". $j['lName'] ?></a></h3>
											<div class="patient-details">
												<h5><i class="far fa-clock"></i> <?=convertTime($i['time']) . ", ".$i['date'] ?> </h5>
												<h5><i class="fas fa-map-marker-alt"></i>  <?= $j['state'].", ". $j['country'] ?></h5>
												<h5><i class="fas fa-envelope"></i>  <?= $j['email'] ?></h5>
												<h5 class="mb-0"><i class="fas fa-phone"></i> <?= $j['phone'] ?></h5>
											</div>
										</div>
									</div>
								
								</div>
								<!-- /Appointment List -->
								<?php } } ?>
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
<?php }
ob_end_flush();
?>