<?php
	if ( $_SESSION['logged_in'] != 1 ) {
		$_SESSION['state']='login';
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
		<title>2048</title>
		<!-- For Mobile -->
		<meta id="meta" name="viewport" content="width=device-width; initial-scale=1.0 user-scalable=0" />
	</head>
	<body class="main">
		<!-- Title -->
		<header><h1>2048</h1></header>
        		
		<!-- PAGE CONTENT -->
		<div id="content">

			<div class="row">
				<div class="main-content">
					<div class="panel">
						<div class="panel-body">
							
								
							<div class="text-center row">
								<!-- Page Message -->
								<div class="text-center row">
									<label><?= $_SESSION['2048Game']->msg ?></label>
								</div><br>
	
								<!-- Restart Button-->
								<form method="post">
									<input class="btn btn-default" type="submit" name="restart" value="RESTART" />
								</form><br>

							</div>
							
							<!-- The Game itself -->
							<div class="row">
								<table border="1" style="margin-left: auto; margin-right: auto;">
								<?php 
								
								
								for ($x = 0; $x <= 3; $x++) {
									echo('<tr>');
									for ($y = 0; $y <= 3; $y++) {
										echo('<th>');
										if ($_SESSION['2048Game']->board[$x][$y] != 0) {
											echo('<a href="index.php?x='.  $x . '&y=' . $y .'"><img width=100% src="images/2048/' . $_SESSION['2048Game']->board[$x][$y] .'.png" alt="tile1" ></a>');
										} else {
											echo('<img width=100% src="images/2048/space.png" alt="tile1" >');
										}
										
										echo('</th>');

									
									}
									echo('</tr>');
								}
								?>
								</table>
							</div>
							<br>
							<!-- Directional Buttons -->
							<div class="text-center row">
								<table width=100%>
									<tr>
										<td></td>
										<td><form method="post">
											<input class="btn btn-default" type="submit" name="up" value="UP" />
										</form></td>
										<td></td>
									</tr>
									
									<tr>
									<td><form method="post">
										<input class="btn btn-default" type="submit" name="left" value="LEFT" />
									</form></td>
									<td></td>
									<td><form method="post">
										<input class="btn btn-default" type="submit" name="right" value="RIGHT" />
									</form></td>
									</tr>
									<tr>
										<td></td>
										<td><form method="post">
											<input class="btn btn-default" type="submit" name="down" value="DOWN" />
										</form></td>
										<td></td>
									</tr>
								</table>
							</div>
							
							<!-- Game Score -->
							<div class="text-center row">
								
								<label>SCORE: <?= $_SESSION['2048Game']->moves?></label>
								
							</div>
							
						</div>
					</div>
				</div>
			</div>
			
			<!-- Game Description -->
			<div class="row">
				<div class="main-content">
					<div class="panel">
						<div class="panel-body">
							
							<div class="row" >
								<div class="text-center margin-none">
									<p>Reach the 2048 tile! Given the four directional buttons, combine tiles together in any fashion you like to reach the 2048 tile.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<!-- PAGE CONTENT -->
		<!-- Difficulty -->
		<?php include_once('difficulty.php'); ?>
		<!-- Navigation Unit -->
		<?php include_once('nav.php'); ?>
		
	</body>
</html>

