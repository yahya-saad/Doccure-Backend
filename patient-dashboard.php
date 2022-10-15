<?php
ob_start();
session_start();
include("conn.php");
if(!isset($_SESSION['patientLogin'])){
	$_SESSION['loginMsg'] = 'You must log in frist!';
	header("Location:login.php");
}else{

?>

<?php
if(isset($_GET['cancel'])){
    	$acceptid=$_GET['cancel'];
    	$updateStatus="UPDATE `appointments` SET status='Cancelled' WHERE id=$acceptid";
    	$update=$conn -> query($updateStatus);
		
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
			<?php  include("patientSlideBar.php") ?>
			<!-- / Profile Sidebar -->
						
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
							<div class="card">
								<div class="card-body pt-0">

									<!-- Tab Menu -->
									<nav class="user-tabs mb-4">
										<ul class="nav nav-tabs nav-tabs-bottom nav-justified">
											<li class="nav-item">
												<a class="nav-link active" href="#pat_appointments" data-toggle="tab">Appointments</a>
											</li>
											
										</ul>
									</nav>
									<!-- /Tab Menu -->
									
									<!-- Tab Content -->
									<div class="tab-content pt-0">
										
										<!-- Appointment Tab -->
										<div id="pat_appointments" class="tab-pane fade show active">
											<div class="card card-table mb-0">
												<div class="card-body">
													<div class="table-responsive">
														<table class="table table-hover table-center mb-0">
															<thead>
																<tr>
																	<th>Doctor</th>
																	<th>Appt Date</th>
																	<th>Booking Date</th>
																	<th>Amount</th>
																	<th>Status</th>
																	<th></th>
																</tr>
															</thead>
															<tbody>
<?php 
// Function that convert time from 24H to 12H format
function convertTime($time){
	if($time > "11:59" && $time < "24:00"){
	echo date("h:i", strtotime($time))." PM";
	}else{
	echo date("h:i", strtotime($time))." AM";
	}
	}
		$patientID=$_SESSION['id'];
		$selectApp="SELECT * FROM `appointments` where patientID=$patientID ORDER BY status DESC" ;
		$selectAppRes=$conn->query($selectApp);
		foreach($selectAppRes as $i){
		$doctorID =$i['doctorID'];
		$selectDoctor=" SELECT * FROM `doctors` where id=$doctorID" ;
		$selectDoctorRes=$conn->query($selectDoctor);					
		foreach($selectDoctorRes as $j){
	?>
																<tr>
																	<td>
																		<h2 class="table-avatar">
																			<a href="doctor-profile.php?id=<?= $j['id']?>" class="avatar avatar-sm mr-2">
																				<img class="avatar-img rounded-circle" src="<?= $j['image'] ?>" alt="User Image">
																			</a>
																			<a href="doctor-profile.php?id=<?= $p['id']?>"><?= $j['fName'] . " ". $j['lName'] ?> <span><?= $j['specialization']?></span></a>
																		</h2>
																	</td>
																	<td><?= $i['date'] ?><span class="d-block text-info"><?= convertTime($i['time']) ?></span></td>
																	<td><?= $i['createdAt'] ?></td>
																	<td><?= $j['price']." £"?></td>
																	
																	<td>
																		<?php 
																		if($i['status'] == "Cancelled" ) $bgColor='bg-danger-light';
																		elseif($i['status'] == "Pending" ) $bgColor='bg-warning-light';
																		elseif($i['status'] == "Confirm" ) $bgColor='bg-success-light';
																		?>
																		<span class="badge badge-pill <?= $bgColor ?>"><?= $i['status'] ?></span>
																</td>
																	<td class="text-right">
																		<div class="table-action">
																			<a href="patient-dashboard.php?cancel=<?= $i['id'] ?>" class="btn btn-sm bg-danger-light">
																				<i class="far fa-trash-alt"></i> Cancel
																			</a>
																		</div>
																	</td>
																</tr>


																<?php } } ?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
										<!-- /Appointment Tab -->
										
										
									</div>
									<!-- Tab Content -->
									
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

<?php } 
ob_end_flush();
?>