<?php
ob_start();
session_start();
include("conn.php");
if(!isset($_SESSION['doctorLogin'])){
	$_SESSION['loginMsg'] = 'You must log in frist!';
	header("Location:doctorlogin.php");
}else{

?>

<?php
    if(isset($_GET['accept'])){
    	$acceptid=$_GET['accept'];
    	$updateStatus="UPDATE `appointments` SET status='Confirm' WHERE id=$acceptid";
    	$update=$conn -> query($updateStatus);
		if($update) {header("Location:doctor-dashboard.php");}
		
    }elseif(isset($_GET['cancel'])){
    	$acceptid=$_GET['cancel'];
    	$updateStatus="UPDATE `appointments` SET status='Cancelled' WHERE id=$acceptid";
    	$update=$conn -> query($updateStatus);
		if($update) {header("Location:doctor-dashboard.php");}
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
									<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Dashboard</h2>
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

						<?php
							if(isset($_SESSION['alreadySign'])){
								echo "<div class='alert alert-success' role='alert'>";
								echo $_SESSION['alreadySign'];
								echo "</div>";
								unset($_SESSION['alreadySign']);
								header("Refresh:1");
							
							}
						?>

							<div class="row">
								<div class="col-md-12">
									<div class="card dash-card">
										<div class="card-body">
											<div class="row">
												<div class="col-md-12 col-lg-4">
													<div class="dash-widget dct-border-rht">
														<div class="circle-bar circle-bar1">
															<div class="circle-graph1" data-percent="75">
																<img src="assets/img/icon-01.png" class="img-fluid" alt="patient">
															</div>
														</div>
														<?php 
														$docID = $_SESSION['id'];
														$countQuery="SELECT * FROM `appointments` where doctorID=$docID " ;
														$countQueryRes =$conn->query($countQuery);
														$numRows = $countQueryRes-> num_rows;
														?>
														<div class="dash-widget-info">
															<h6>Total Patient</h6>
															<h3><?= $numRows ?></h3>
															<p class="text-muted">Till Today</p>
														</div>
													</div>
												</div>

												<div class="col-md-3 col-lg-4">
													<div class="dash-widget">
														<div class="circle-bar circle-bar3">
															<div class="circle-graph3" data-percent="60">
																<img src="assets/img/icon-03.png" class="img-fluid" alt="Patient">
															</div>
														</div>
														<?php 
														$docID = $_SESSION['id'];
														$currentdate=date("Y-m-d");
														$countQuery="SELECT * FROM `appointments` where doctorID=$docID AND status='Confirm' " ;
														$countQueryRes =$conn->query($countQuery);
														$numRows = $countQueryRes-> num_rows;
														?>
														<div class="dash-widget-info">
															<h6>Appoinments</h6>
															<h3><?= $numRows ?></h3>
															<p class="text-muted">Confirmed</p>
														</div>
													</div>
												</div>
												
												
												
												<div class="col-md-12 col-lg-4">
													<div class="dash-widget">
														<div class="circle-bar circle-bar3">
															<div class="circle-graph3" data-percent="60">
																<img src="assets/img/icon-03.png" class="img-fluid" alt="Patient">
															</div>
														</div>
														<?php 
														$docID = $_SESSION['id'];
														$currentdate=date("Y-m-d");
														$countQuery="SELECT * FROM `appointments` where doctorID=$docID AND status='Cancelled' " ;
														$countQueryRes =$conn->query($countQuery);
														$numRows = $countQueryRes-> num_rows;
														?>
														<div class="dash-widget-info">
															<h6>Appoinments</h6>
															<h3><?= $numRows ?></h3>
															<p class="text-muted">Cancelled</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<h4 class="mb-4">Patient Appoinment</h4>
									<div class="appointments">
							<?php 
							// Function that convert time from 24H to
							function convertTime($time){
								if($time > "11:59" && $time < "24:00"){
								echo date("h:i", strtotime($time))." PM";
								}else{
								echo date("h:i", strtotime($time))." AM";
								}
								}

							$docID=$_SESSION['id'];
							$selectApp="SELECT * FROM `appointments` where doctorID=$docID AND status='Pending' ORDER BY id DESC" ;
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
												<a href="patient-profile.html" class="booking-doc-img">
													<img src=" <?= $j['image'] ?>" alt="User Image">
												</a>
												<div class="profile-det-info">
													<h3><a href="patient-profile.html"><?= $j['fName'] . " ". $j['lName'] ?></a></h3>
													<div class="patient-details">
														<h5><i class="far fa-clock"></i> <?=convertTime($i['time']) . ", ".$i['date'] ?></h5>
														<h5><i class="fas fa-map-marker-alt"></i> <?= $j['state'].", ". $j['country'] ?></h5>
														<h5><i class="fas fa-envelope"></i> <?= $j['email'] ?></h5>
														<h5 class="mb-0"><i class="fas fa-phone"></i>  <?= $j['phone'] ?></h5>
													</div>
												</div>
											</div>
											<div class="appointment-action">
												
												<a href="doctor-dashboard.php?accept=<?= $i['id'] ?>" class="btn btn-sm bg-success-light">
													<i class="fas fa-check"></i> Accept
												</a>
												<a href="doctor-dashboard.php?cancel=<?= $i['id'] ?>" class="btn btn-sm bg-danger-light">
													<i class="fas fa-times"></i> Cancel
												</a>
											</div>
										</div>
					
										<!-- /Appointment List -->

										<?php } } ?>
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
		
		<!-- Circle Progress JS -->
		<script src="assets/js/circle-progress.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

</html>

<?php }
 ob_end_flush();
  ?>