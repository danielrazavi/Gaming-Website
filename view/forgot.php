<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>Games</title>
		<!-- For Mobile -->
		<meta id="meta" name="viewport" content="width=device-width; initial-scale=1.0 user-scalable=0" />
	</head>

	<body class="login">
		<div id="content">
			<div class="lock-container">
				<!-- Title -->
				<h1 id="login_banner">Forgot Password</h1>
				<div class="panel text-center">
					<div class="panel-body">
					
						<!-- Give Username Page -->
						<?php if ($_SESSION['state'] == "forgot") { ?>
							<form method="post">
								<input class="forms" type="text" name="user" placeholder="Username" required/>

								<input class="btn" type="submit" name="forgot" value="Check Username"/>
								</th><td><?php echo(view_errors($errors)); ?>
							</form>
						<?php } ?>
						
						<!-- Answer Security Question Page -->
						<?php if ($_SESSION['state'] == "ask") { ?>
							<label><?= $_SESSION['sequ']?></label>
							<form method="post">
								<input class="forms" type="text" name="sequ_ans" placeholder="Answer" required/>

								<input class="btn" type="submit" name="ask" value="Reset Password"/>
								</th><td><?php echo(view_errors($errors)); ?>
							</form>
						<?php } ?>
						
						<!-- Change Password Page -->
						<?php if ($_SESSION['state'] == "reset_pass") { ?>
							<form method="post">
								<input class="forms" type="password" name="newpass" value="" required/>

								<input class="btn" type="submit" name="reset_pass" value="Set New Password"/>
								</th><td><?php echo(view_errors($errors)); ?>
							</form>
						<?php } ?>

						<!-- Back Button -->
						<a href="index.php?a=logout" class="register">Back</a>
					</div>
				</div>
			</div>

		</div>
	</body>
</html>
