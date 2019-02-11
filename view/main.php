<?php
	if ($_SESSION['logged_in'] != 1 ) {
		$_SESSION['state']='login';
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>Profile</title>
		<!-- For Mobile -->
		<meta id="meta" name="viewport" content="width=device-width; initial-scale=1.0 user-scalable=0" />
	</head>
	<body>
		<header><h1>Welcome <?= $_SESSION['user'] ?>!</h1></header>
		<!-- PAGE CONTENT -->
		<div id="content">
			<!-- Account Forms -->
			<div class="row">
				<div class="main-content">
					<div class="panel">
						<div class="panel-body">

							<form method="post">
								<!-- First and Last Name -->
								<div class="row">
									<div class="input-name">
										<label>First name</label>
										<input class="forms" type="text" name="firstname" value=<?= $_SESSION['firstname']?>>
									</div>
									<div class="input-name">
										<label>Last name</label>
										<input class="forms" type="text" name="lastname" value=<?= $_SESSION['lastname']?>>
									</div>
								</div>
								<!-- Email Address -->
								<div class="row">
									<label>Email address</label>
									<input class="forms" type="email" name="email" value=<?= $_SESSION['email']?>>
								</div>
								<!-- Old Address -->
								<div class="row">
									<label>Old Password</label>
									<input class="forms" type="password" name="oldpassword" value="">
								</div>
								<!-- New Password -->
								<div class="row">
									<label>New Password</label>
									<input class="forms" type="password" name="newpassword" value="">
								</div>
								<!-- Major -->
								<div class="row">
									<label>Major</label>
									<input class="forms" type="text" name="major" value=<?= $_SESSION['major']?>>
								</div>
								<!-- Campus -->
								<div class="row">
									<label>Campus</label>
									<div class="forms">
										<select style="width: 100%;" name="campus">
											<optgroup label="University of Toronto">
												<option value="M">Missauaga</option>
												<option value="G">St. George</option>
												<option value="S">Scarborough</option>
											</optgroup>
										</select>
									</div>
								</div>
								<br>
								<!-- Save Button -->
								<div class="text-center row">
									<input class="btn text-center" type="submit" name="submit" value="Save Changes" />
									
								</div>
							</form>
							<br>
							<!-- Deactivate Account Button -->
							<form method="post">
								<div class="text-center row">
									<input class="btn text-center" type="submit" name="deactivate" value="Deactivate Account" />
									
								</div>
							</form>
							
							<!-- Potential Message -->
							<div class="text-center row">
									
								<?php echo(view_errors($errors)); ?>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- PAGE CONTENT -->
		<?php include_once('nav.php'); ?>
	</body>
</html>
