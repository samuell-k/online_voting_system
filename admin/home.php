<!DOCTYPE html>
<?php 
	require 'validator.php';
	require_once 'conn.php'
?>
<html lang="en">
<head>
	<title>School File Management System</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
		<div class="container-fluid">
			<label class="navbar-brand">School File Management System</label>
			<?php 
				$query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_id` = '$_SESSION[user]'") or die(mysqli_error());
				$fetch = mysqli_fetch_array($query);
			?>
			<ul class="nav navbar-right">	
				<li class="dropdown">
					<a class="user dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="glyphicon glyphicon-user"></span>
						<?php echo $fetch['firstname']." ".$fetch['lastname']; ?>
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="#" data-toggle="modal" data-target="#logoutModal">
								<i class="glyphicon glyphicon-log-out"></i> Logout
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>

	<!-- Logout Confirmation Modal -->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p class="text-danger">Are you sure you want to log out?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<a href="logout.php" class="btn btn-danger">Logout</a>
				</div>
			</div>
		</div>
	</div>

	<?php include 'sidebar.php' ?>
	<div id="content">
		<br /><br /><br />
		<div class="alert alert-info"><h3>Mission</h3></div> 
		<p>
		The School File Management System aims to streamline the process of managing and securing student files within a school environment. By offering a centralized platform to store, manage, and retrieve student records, this system ensures that educational institutions can efficiently manage their documentation, save time, and reduce manual errors. Additionally, the system aims to enhance security by allowing administrative control over user access and automatically removing related files when a student is deleted. The mission is to improve file management efficiency, data integrity, and security for schools.

		</p>
		
		<div class="alert alert-info"><h3>Vision</h3></div> 
		<p>
		The vision of the School File Management System is to become a comprehensive and reliable digital solution for educational institutions around the world. It envisions a future where schools can manage their student documentation effortlessly, with minimal administrative burden, and focus more on providing quality education. By continuously improving the system’s capabilities, including enhanced automation, scalability, and data security features, it aims to become the go-to file management solution for schools, making the handling of student records seamless and secure.

		</p>
	</div>

	<div id="footer">
		<label class="footer-title">&copy; Copyright School File Management System <?php echo date("Y", strtotime("+8 HOURS"))?></label>
	</div>

	<?php include 'script.php' ?>
</body>
</html>
