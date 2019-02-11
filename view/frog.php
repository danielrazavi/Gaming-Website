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
		<title>Frog Game</title>
		<!-- For Mobile -->
		<meta id="meta" name="viewport" content="width=device-width; initial-scale=1.0 user-scalable=0" />
	</head>
	<body class="main">
		<header><h1>Frog Game</h1></header>
   
		<!-- PAGE CONTENT -->
		<div id="content">
				<div class="row">
				<div class="main-content">
					<div class="panel">
						<div class="panel-body">
							<!-- The Actual Frog Game -->
							<div class="row">
								<table style="margin-left: auto; margin-right: auto;"><tr>
								<div class="text-center row">
									<label><?= $_SESSION['FrogGame']->msg ?></label>
								</div><br>
								<?php 
								
								
								$count = count($_SESSION['FrogGame']->frogs)-1;
								for ($x = 0; $x <= $count; $x++) {

									echo('<th>');
									if ($_SESSION['FrogGame']->frogs[$x] != 0) {
										echo('<a href="index.php?frog='.  $x . '"><img width=100% src="images/frogs/' . $_SESSION['FrogGame']->frogs[$x] .'.png" alt="tile1" ></a>');
									} else {
										echo('<img width=100% src="images/frogs/space.png" alt="tile1" >');
									}
									
									echo('</th>');

								}
								?>
								</tr></table>
							</div>
							
							<!-- New Game and Game Score -->
							<div class="text-center row">
							
								<form method="post">
									<input class="btn btn-default" type="submit" name="new" value="NEW GAME" />
								</form>
								<label>SCORE: <?= $_SESSION['FrogGame']->moves?></label>
								
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
									<p>By clicking any frog, you will move that frog (and any frog of the same color) forward. If the frog is faced with a frog of different color, the frog has the ability to jump over the other frog, given that there is an empty space behind the other frog. The goal is to get the two frog groups to go from the side they are placed originally, and to go to the other side.</p>
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

