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
		<title>Slide Puzzle</title>
		<!-- For Mobile -->
		<meta id="meta" name="viewport" content="width=device-width; initial-scale=1.0 user-scalable=0" />
	</head>
	<body class="main">
		<header><h1>Slide Puzzle</h1></header>
        
		
		<!-- PAGE CONTENT -->
		<div id="content">
			<div class="row">
				<div class="main-content">
					<div class="panel">
						<div class="panel-body">
							
							<!-- Slide Game Itself -->
							<div class="row">
								<table border="1" style="margin-left: auto; margin-right: auto;">
								<?php 
								if ($_SESSION['SlideGame']->msg == "YOU WIN!") {?>
									<div class="text-center row">
										<label><?= $_SESSION['SlideGame']->msg ?></label>
									</div><br>
								<?php } ?>
								<?php 
								
								$count = count($_SESSION['SlideGame']->board[0]);
								for ($x = 0; $x <= $count-1; $x++) {
									echo('<tr>');
									for ($y = 0; $y <= $count-1; $y++) {
										echo('<th>');
										if ($_SESSION['SlideGame']->board[$x][$y] != 0) {
											echo('<a href="index.php?x='.  $x . '&y=' . $y .'"><img width=100% src="images/15tiles/' . $_SESSION['SlideGame']->board[$x][$y] .'.png" alt="tile1" ></a>');
										}
										
										echo('</th>');

									
									}
									echo('</tr>');
								}
								?>
								</table>
							</div>
							
							<!-- Shuffle Button and Score -->
							<div class="text-center row">
							<br>
								<form method="post">
									<input class="btn btn-default" type="submit" name="new" value="SHUFFLE" />
								</form>
								
								<label>SCORE: <?= $_SESSION['SlideGame']->moves?></label>
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
									<p>You can make moves by clicking a tile and if that tile has a neighboring empty space, then that tile will move there. Using such technique, rearrange the given randomized tiles to get them arranged in order.</p>
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

