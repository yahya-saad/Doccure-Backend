<?php
ob_start();
include("conn.php");
if(!isset($_SESSION['doctorLogin'])){
	$_SESSION['msg'] = 'You must login frist!';
	header("Location:doctorlogin.php");
}else{
	$id	= $_SESSION['id'];
	$selectDoctors = "SELECT * FROM `doctors` where id=$id";
	$select = $conn->query($selectDoctors);
	foreach($select as $p){
?>
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
												<h5 class="mb-0"><?= $p['specialization']?></h5>
											</div>
										</div>
									</div>
								</div>
								<div class="dashboard-widget">
									<nav class="dashboard-menu">
										<ul>
											<li>
												<a href="doctor-dashboard.php">
													<i class="fas fa-columns"></i>
													<span>Dashboard</span>
												</a>
											</li>
											<li>
												<a href="appointments.php">
													<i class="fas fa-calendar-check"></i>
													<span>Appointments</span>
												</a>
											</li>
											
										
											<li>
												<a href="doctor-profile-settings.php">
													<i class="fas fa-user-cog"></i>
													<span>Profile Settings</span>
												</a>
											</li>
											<li>
												<a href="change-doc-password.php">
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
									<?php }  ?>
								</div>
							</div>
	</div>
<?php }  
ob_end_flush();
?>