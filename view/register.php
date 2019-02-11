<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>Games</title>
		<!-- For Mobile -->
		<meta id="meta" name="viewport" content="width=device-width; initial-scale=1.0 user-scalable=0"/>
	</head>

	<body class="login">
		<div id="content">
			<div class="lock-container">
				<h1 id="registration_banner">Games Register</h1>
				<div class="panel text-center reg">

					<div class="panel-body">
						<form method="post">
							<!-- Username -->
							<div class="row">
								<input class="forms" type="text" name="user" placeholder="Username"required>
							</div>
							<!-- First Name and Last Name -->
							<div class="row">
								<div class="input-name">
									<input class="forms" type="text" name="firstname" placeholder="First Name"required>
								</div>
								<div class="input-name">
									<input class="forms" type="text" name="lastname" placeholder="Last Name" required>
								</div>
							</div>
							<!-- Email Address -->
							<div class="row">
								<input class="forms" type="email" name="email" placeholder="Email Address " required>
							</div>
							<!-- Password -->
							<div class="row">
								<input class="forms" type="password" name="password" placeholder="Password" required>
							</div>
							
							<!-- Gender -->
							<div class="row">
								<label>Gender</label>
								<input type="radio" name="gender" value="male"> Male<br>
								<input type="radio" name="gender" value="female"> Female<br>
								<input type="radio" name="gender" value="other"> Other
							</div>	
							
							<!-- Major -->
							<div class="row">
								<input class="forms" type="text" name="major"  pattern="[^\s]+" placeholder="Major of Study (NO SPACES)">
							</div>
							<!-- Security Question -->
							<div class="row">
								<input class="forms" type="text" name="sequ" placeholder="Security Question" required>
							</div>
							<!-- Security Question's Answer -->
							<div class="row">
								<input class="forms" type="text" name="sequ_ans" placeholder="Answer" required>
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
							
							
							
							<!-- Date of Birth Menu Option -->
							<div class="row">
								<label>Date of Birth</label>
								<!-- Date Restrictions have been made -->
								<input class="forms" type="date" name="dob" min="1950-01-01" max=<?php echo date("Y-m-d")?> required>
							</div>
							<!-- Registration Button -->
							<input class="btn" type="submit" name="submit" value="Register" />
							</th><td><?php echo(view_errors($errors)); ?>
						</form>
						<!-- Back Button -->
						<a href="index.php?a=logout" class="register">Back</a>
					</div>
				</div>
			</div>

		</div>
	</body>
</html>
