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
		<title>Game Stats</title>
		<!-- For Mobile -->
		<meta id="meta" name="viewport" content="width=device-width; initial-scale=1.0 user-scalable=0" />
	</head>
	<body>
		<header><h1>Game Stats</h1></header>

		<br>
		<!-- PAGE CONTENT -->
		<div id="content">
			<!-- CHOOSE GAME -->
			<div class="row">
				<div class="main-content">
					<div class="panel">
						<div class="panel-body">

							<div class="stats">

								<ul>
									<li>
										<form method="post">
											<input class="btn btn-default" type="submit" name="guess" value="GUESS GAME" />
										</form>
									</li>

									<li>
										<form method="post">
											<input class="btn btn-default" type="submit" name="fifteen" value="SLIDE PUZZLE" />
										</form>
									</li>

									<li>
										<form method="post">
											<input class="btn btn-default" type="submit" name="frog" value="FROG GAME" />
										</form>
									</li>

									<li>
										<form method="post">
											<input class="btn btn-default" type="submit" name="2048" value="2048" />
										</form>
									</li>

								</ul>

							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- CHOOSE GAME -->

			<?php include_once('difficulty.php'); ?>

			<!-- SCORES -->
			<div class="row games">
				<div class="main-content">
					<div class="panel">
						<div class="panel-body">
							<div class="row text-center margin-none games">
								<p>
									<?= $_SESSION['topscores']?> High Scores
									<?php
									if ( $_SESSION['topscores'] != "2048Game") {
										if ($_SESSION['topmode'] == 0) {
											echo " On Easy";
										} else if ($_SESSION['topmode'] == 1) {
											echo " On Medium";
										} else if ($_SESSION['topmode'] == 2) {
											echo " On Hard";
										}
									}
									?>
								</p>
							</div>


							<div class="row text-center" >
								<table width=100%>

									<tr>
										<th>
											<p>Username</p>
										</th>

										<th>
											<p>Score</p>
										</th>
									</tr>

									<?php


									for ($x = 0; $x <= count($_SESSION['statsnames'])-1; $x++) {
										echo '<tr><td>' . $_SESSION['statsnames'][$x] . '</td>';
										echo '<td>' . $_SESSION['statsscores'][$x] . '</td></tr>';
									}

									?>


								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- SCORES -->


		</div>
		<!-- PAGE CONTENT -->
		<?php include_once('nav.php'); ?>

	</body>
</html>
