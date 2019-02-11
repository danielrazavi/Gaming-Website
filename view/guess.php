<?php
	$_REQUEST['guess']=!empty($_REQUEST['guess']) ? $_REQUEST['guess'] : '';
	
	if ( $_SESSION['logged_in'] != 1 ) {
		$_SESSION['state']='login';
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
		<title>Guess Game</title>
		<!-- For Mobile -->
		<meta id="meta" name="viewport" content="width=device-width; initial-scale=1.0 user-scalable=0" />
	</head>
	<body class="main">
		<header><h1>Guess Game</h1></header>
        
		<!-- PAGE CONTENT -->
		<div id="content">
			<!-- The Actual Guess Game -->
			<div class="row">
				<div class="main-content">
					<div class="panel">
						<div class="panel-body">
							
							<?php if($_SESSION["GuessGame"]->getState()!="correct"){ ?>
								<form method="post">
									<div class="row">
										<input class="forms" type="text" name="guess" value="<?php echo($_REQUEST['guess']); ?>" /> 
									</div>
									</br>
									<div class="text-center row">
										<input class="btn" type="submit" name="submit" value="GUESS" />
									</div>
								</form>
							<?php } ?>
							
							<?php echo(view_errors($errors)); ?> 

							<?php 
								foreach($_SESSION['GuessGame']->history as $key=>$value){
									echo('<div class="text-center row">'. $value .'</div>');
								}
								if($_SESSION["GuessGame"]->getState()=="correct"){ 
							?>
							<!-- Restart Game Button -->
							<div class="text-center row">
								<form method="post">
									<input class="btn" type="submit" name="restart" value="PLAY AGAIN" />
								</form>
							</div>
								
							<?php } ?>
							<!-- Game Score -->
							<div class="text-center row">
								<label>SCORE: <?= $_SESSION['GuessGame']->moves?></label>
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
									<p>
										Guess a number between 1 and 
										<?php 
										if ($_SESSION["GuessGame"]->hard == 0) {
											echo '10';
										} else if ($_SESSION["GuessGame"]->hard == 1) {
											echo '100';
										} else if ($_SESSION["GuessGame"]->hard == 2) {
											echo '1000';
										}
										?> The lower number of guesses, the higher the score.
									
									</p>
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

