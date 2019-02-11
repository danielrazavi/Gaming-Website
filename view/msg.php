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
		<title>Message Board</title>
		<!-- For Mobile -->
		<meta id="meta" name="viewport" content="width=device-width; initial-scale=1.0 user-scalable=0" />
	</head>
	<body class="main">
		<header><h1>Message Board</h1></header>
        

		<!-- PAGE CONTENT -->
		<div id="content">
			<div class="row">
				<div class="main-content">
					<div class="panel">
						<div class="panel-body">
							
							
								<form method="post">
									<div class="row">
										<input class="forms" type="text" name="msg" value="" /> 
									</div>
									</br>
									<div class="text-center row">
										<input class="btn" type="submit" name="submit" value="POST" />
									</div>
								</form>
							
						</div>
					</div>
				</div>
			</div>
		
			<div class="row">
				<div class="main-content">
					<div class="panel">
						<div class="panel-body">
								
								<div class="row" >
								<table width=100%>
									<?php


									for ($x = 0; $x <= count($_SESSION['msguser'])-1; $x++) {
										echo '<tr><td width="5%">' . $_SESSION['msguser'][$x] . ':</td>';
										echo '<td width="95%">' . $_SESSION['msgtext'][$x] . '</td></tr>';
									}

									?>


								</table>
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

