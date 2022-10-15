<?php
ob_start();
session_start();
include("conn.php");
if(!isset($_SESSION['patientLogin'])){
	$_SESSION['loginMsg'] = 'You must log in frist!';
		header("Location:login.php");
}else{
$docID=$_GET['id'];
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
									<li class="breadcrumb-item active" aria-current="page">Booking</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Booking</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container">
				
					<div class="row">
						<div class="col-12">
						<?php 
						$selectDoc = "SELECT * from doctors where id=$docID";
						$select=$conn->query($selectDoc);
						foreach($select as $p){
						?>
							<div class="card">
								<div class="card-body">
									<div class="booking-doc-info">
										<a href="doctor-profile.html" class="booking-doc-img">
											<img src="<?= $p['image'] ?>" alt="User Image">
										</a>
										<div class="booking-info">
											<h4><a href="doctor-profile.html"><?= $p['fName'] . " ". $p['lName'] ?></a></h4>
										
											<p class="text-muted mb-3 "><i class="fas fa-map-marker-alt mr-2"></i><?= $p['state'].", ". $p['country'] ?> </p>
											<p class="doc-location">
												<i class="far fa-money-bill-alt mr-2"></i> <?= $p['price']?>
											</p>
										</div>
									</div>
								</div>
							</div>


							<form  action="bookingInsert.php" method="POST">
							<input type="hidden" name="docID" value="<?=$p['id']?>" >
								<div class="row">
									<div class="col-md-6">
										<div class="card">
										<div class="card-body">
											<h3>Choose your Appointment Date</h3>
											<input type="date" class="form-control" required name="date" >
										</div>
									</div>
									</div>
									<div class="col-md-6">
										<div class="card">
										<div class="card-body">
											<h3>Choose your Appointment Time</h3>
											<input type="time" class="form-control" required name="time" >
										</div>
									</div>
									</div>
								</div>
								

							<!-- Submit Section -->
							<div class="submit-section proceed-btn text-right">
								<button type="submit" class="btn btn-primary submit-btn" name="submit">Make Appointment</button>
							</div>
							<!-- /Submit Section -->
							
							
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
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

</html>
<?php }
ob_end_flush();
?>