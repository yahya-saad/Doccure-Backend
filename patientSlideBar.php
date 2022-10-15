<?php
ob_start();
include("conn.php");
if(!isset($_SESSION['patientLogin'])){
	$_SESSION['msg'] = 'You must login frist!';
	header("Location:login.php");
}else{
	$id	= $_SESSION['id'];
	$selectPatient = "SELECT * FROM `patients` where id=$id";
	$select = $conn->query($selectPatient);
	foreach($select as $p){

?>
			<!-- Profile Sidebar -->
						<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
						<div class="profile-sidebar">
								<div class="widget-profile pro-widget-content">
									<div class="profile-info-widget">
										<a href="#" class="booking-doc-img">
											<img src="<?= $p['image']?>" alt="User Image">
										</a>
										<div class="profile-det-info">
											<h3><?= $p['fName'] . " ". $p['lName'] ?></h3>
											<div class="patient-details">
												<h5><i class="fas fa-birthday-cake"></i> <?= $p['dateOfBirth']?></h5>
												<h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> <?= $p['state'].", ". $p['country'] ?></h5>
											</div>
										</div>
									</div>
								</div>
								<div class="dashboard-widget">
									<nav class="dashboard-menu">
										<ul>
											<li>
												<a href="patient-dashboard.php">
													<i class="fas fa-columns"></i>
													<span>Dashboard</span>
												</a>
											</li>
											<li>
												<a href="doctors.php">
													<i class="fas fa-user-md"></i>
													<span>Doctors</span>
												</a>
											</li>
											<li>
												<a href="profile-settings.php">
													<i class="fas fa-user-cog"></i>
													<span>Profile Settings</span>
												</a>
											</li>
											<li>
												<a href="change-password.php">
													<i class="fas fa-lock"></i>
													<span>Change Password</span>
												</a>
											</li>
											<li>
												<a href="logout.php">
													<i class="fas fa-sign-out-alt"></i>
													<span>Logout</span>
												</a>
											</li>
										</ul>
										
									</nav>
									<?php  } ?>
								</div>

							</div>
						</div>
						<!-- / Profile Sidebar -->
				<?php } 
				ob_end_flush();
				?>