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
				<h1 id="login_banner">Games Login</h1>
				<div class="panel text-center">

					<div class="panel-body">
						<form method="post">
							<!-- Username Input-->
							<input class="forms" type="text" name="user" placeholder="Username" required/>
							<!-- Password -->
							<input class="forms" type="password" name="password" placeholder="Password" required/>
							<!-- Login Button -->
							<input class="btn" type="submit" name="submit" value="Login"/>
							<!-- Potential Message -->
							</th><td><?php echo(view_errors($errors)); ?>
						</form>
						<!-- Forgot Password Button -->
						<a href="index.php?a=forgot" class="register">Forgot password?</a>
						<!-- New User Button -->
						<a href="index.php?a=register" class="register">Register</a>
					</div>
				</div>
			</div>

		</div>
	</body>
</html>
