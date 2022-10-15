<header class="header">
				<nav class="navbar navbar-expand-lg header-nav">
					<div class="navbar-header">
						<a id="mobile_btn" href="javascript:void(0);">
							<span class="bar-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
						</a>
						<a href="index.php" class="navbar-brand logo">
							<img src="assets/img/logo.png" class="img-fluid" alt="Logo">
						</a>
					</div>
					<div class="main-menu-wrapper">
						<div class="menu-header">
							<a href="index.php" class="menu-logo">
								<img src="assets/img/logo.png" class="img-fluid" alt="Logo">
							</a>
							<a id="menu_close" class="menu-close" href="javascript:void(0);">
								<i class="fas fa-times"></i>
							</a>
						</div>
						<ul class="main-nav">
							<li class="active">
								<a href="index.php">Home</a>
							</li>
							
							<li class="login-link">
								<a href="whologin.php">Login / Signup</a>
							</li>
						</ul>		 
					</div>		 
					<ul class="nav header-navbar-rht">
						
						
						<?php 
						if(isset($_SESSION['doctorLogin']) || isset($_SESSION['patientLogin']) ){?>

							<li class="nav-item">
							<a class="nav-link header-login" href="logout.php">logout</a>
						</li>

						<?php }else{?>
						<li class="nav-item">
							<a class="nav-link header-login" href="whologin.php">login / Signup </a>
						</li>
						<?php } ?>
						

					</ul>
				</nav>
			</header>