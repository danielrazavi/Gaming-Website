<?php
	ini_set('display_errors', 'On');
	require_once "lib/lib.php";


    require_once "model/guessgame.php";
    require_once "model/fifteengame.php";
	require_once "model/froggame.php";
	require_once "model/2048game.php";

	session_save_path("sess");
	session_start();

	$dbconn = db_connect();

	$errors=array();
	$view="";


	/* controller code */

	/* local actions, these are state transforms */
	if(!isset($_SESSION['state'])){
		$_SESSION['state']='login';
	}

    // set to a state
    if(isset($_GET['a'])){
        $_SESSION['state']=$_GET['a'];

		unset($_SESSION["GuessGame"]);
		unset($_SESSION["FrogGame"]);
		unset($_SESSION["SlideGame"]);
		unset($_SESSION["2048Game"]);

		header("location: index.php");
    }

	switch($_SESSION['state']){
        case "error":
			$view="error.php";
			break;
		case "main":
			$view="main.php";

			if(!$dbconn){
				$errors[]="Can't connect to db";
				break;
			}
			
			if(array_key_exists('deactivate', $_POST)){
				$query = "DELETE FROM appuser WHERE userid=$1;";
				$result = pg_prepare($dbconn, "deluser_query1", $query);
				$result = pg_execute($dbconn, "deluser_query1", array($_SESSION['user']));

				$query = "DELETE FROM scores WHERE userid=$1;"; //for the gamescore relation
				$result = pg_prepare($dbconn, "deluser_query2", $query);
				$result = pg_execute($dbconn, "deluser_query2", array($_SESSION['user']));

				$query = "DELETE FROM msg WHERE userid=$1;"; //for the msg relation
				$result = pg_prepare($dbconn, "deluser_query3", $query);
				$result = pg_execute($dbconn, "deluser_query3", array($_SESSION['user']));

				session_destroy();
				header("location: index.php");
			}
			
			// check if submit or not
			if(empty($_POST['submit']) || $_POST['submit']!="Save Changes"){
				break;
			}

			// update password
			if(!empty($_POST['newpassword'])) {
				if (!empty($_POST['oldpassword'])) {
					// match with old password
					$query = "SELECT * FROM appuser WHERE userid=$1 and password=(CRYPT($2, password));";
					$result = pg_prepare($dbconn, "check_pass_query", $query);

					$result = pg_execute($dbconn, "check_pass_query", array($_SESSION['user'], $_POST['oldpassword']));
					if($row = pg_fetch_array($result, NULL, PGSQL_ASSOC)){
						// update the password on db
						$query = "UPDATE appuser SET password=(CRYPT($2, password)) WHERE userid=$1;";
						$result = pg_prepare($dbconn, "update_pass_query", $query);
						$result = pg_execute($dbconn, "update_pass_query", array($_SESSION['user'], $_POST['newpassword']));
					} else {
						$errors[]="old passwords wrong";
						break;
					}
				} else {
					$errors[]='old password is required';
					break;
				}
			}

			$query = "UPDATE appuser SET firstname=$2, lastname=$3, email=$4, major=$5, campus=$6 WHERE userid=$1;";
			$result = pg_prepare($dbconn, "update_query", $query);
			$result = pg_execute($dbconn, "update_query", array($_SESSION['user'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['major'], $_POST['campus']));
			$errors[]="changes saved";

			$_SESSION['firstname'] = $_POST["firstname"];
			$_SESSION['lastname'] = $_POST["lastname"];
			$_SESSION['email'] = $_POST["email"];
			$_SESSION['major'] = $_POST["major"];
			$_SESSION['campus'] = $_POST["campus"];

			break;

		case "stats":
			$view="stats.php";
			if(!isset($_SESSION['topscores'])){
				$_SESSION['topscores'] = "GuessGame";
				$_SESSION['topmode'] = 0;
			}

			// guess game
			if(array_key_exists('guess', $_POST)){
			   $_SESSION['topscores'] = "GuessGame";
			}
			
			// slide game
			if(array_key_exists('fifteen', $_POST)){
			   $_SESSION['topscores'] = "SlideGame";
			}
			
			// frog game
			if(array_key_exists('frog', $_POST)){
			   $_SESSION['topscores'] = "FrogGame";
			}
			
			// 2048 game
			if(array_key_exists('2048', $_POST)){
			   $_SESSION['topscores'] = "2048Game";
			}
			
			// difficulty
			if(array_key_exists('easy', $_POST)){
			   $_SESSION['topmode'] = 0;
			}
			if(array_key_exists('medium', $_POST)){
				if ($_SESSION['topscores'] == "2048Game") {
					$_SESSION['topmode'] = 0;
				} else {
					$_SESSION['topmode'] = 1;
				}
			}
			if(array_key_exists('hard', $_POST)){
			   if ($_SESSION['topscores'] == "2048Game") {
					$_SESSION['topmode'] = 0;
				} else {
					$_SESSION['topmode'] = 2;
				}
			}
			
			if(!$dbconn){
				$errors[]="Can't connect to db";
				break;
			}
			
			$query = "SELECT * FROM scores WHERE gameid=$1 AND difficulty=$2 ORDER BY score DESC;";
            $result = pg_prepare($dbconn, "stats_query", $query);

            $result = pg_execute($dbconn, "stats_query", array($_SESSION['topscores'], $_SESSION['topmode']));
         
			$_SESSION['statsnames'] = array();
			$_SESSION['statsscores'] = array();
			while ($row = pg_fetch_array($result)) {
				array_push($_SESSION['statsnames'], $row['userid']);
				array_push($_SESSION['statsscores'], $row['score']);
			}
			break;

		case "login":
			// the view we display by default
			$view="login.php";

			// check if submit or not
			if(empty($_POST['submit']) || $_POST['submit']!="Login"){
				break;
			}

			// validate and set errors
			//if(empty($_POST['user']))$errors[]='user is required';
			//if(empty($_POST['password']))$errors[]='password is required';
			if(!empty($errors))break;

			// perform operation, switching state and view if necessary
			if(!$dbconn){
				$errors[]="Can't connect to db";
				break;
			}
			$query = "SELECT * FROM appuser WHERE userid=$1 and password=(CRYPT($2, password));";
            $result = pg_prepare($dbconn, "login_query", $query);

            $result = pg_execute($dbconn, "login_query", array($_POST['user'], $_POST['password']));
            if($row = pg_fetch_array($result, NULL, PGSQL_ASSOC)){
				$_SESSION['user']=$_POST['user'];

				$_SESSION['firstname'] = $row["firstname"];
				$_SESSION['lastname'] = $row["lastname"];
				$_SESSION['email'] = $row["email"];
				$_SESSION['major'] = $row["major"];
				$_SESSION['campus'] = $row["campus"];
				$_SESSION['dob'] = $row["dob"];
				$_SESSION['gender'] = $row["gender"];


				$_SESSION['logged_in'] = 1;
				$_SESSION['state']='main';
				$view="main.php";
			} else {
                $_SESSION['logged_in'] = 0;
				$errors[]="invalid login";
			}
			break;
		case "forgot":
			$view="forgot.php";
		
			// check if submit or not
			if(empty($_POST['forgot'])){
				break;
			}
			
			if(!empty($errors))break;
			
			// perform operation, switching state and view if necessary
			if(!$dbconn){
				$errors[]="Can't connect to db";
				break;
			}
			
			$query = "SELECT * FROM appuser WHERE userid=$1;";
            $result = pg_prepare($dbconn, "check_query", $query);
            $result = pg_execute($dbconn, "check_query", array($_POST['user']));
            if($row = pg_fetch_array($result, NULL, PGSQL_ASSOC)){
				$_SESSION['user'] = $_POST['user'];
				$_SESSION['sequ'] = $row["sequ"];
				$_SESSION['state'] ='ask';
			} else {
				$errors[]="invalid username";
			}
		
			break;
		case "ask":
			$view="forgot.php";
			// check if submit or not
			if(empty($_POST['ask'])){
				break;
			}
			
			if(!empty($errors))break;
			
			// perform operation, switching state and view if necessary
			if(!$dbconn){
				$errors[]="Can't connect to db";
				break;
			}
			
			$query = "SELECT * FROM appuser WHERE userid=$1 and sequ_ans=$2;";
            $result = pg_prepare($dbconn, "check_query", $query);
            $result = pg_execute($dbconn, "check_query", array($_SESSION['user'], $_POST['sequ_ans']));
            if($row = pg_fetch_array($result, NULL, PGSQL_ASSOC)){
				$_SESSION['state'] = 'reset_pass';
			} else {
				$errors[]="answer does not match";
			}
			
			break;
			
		case "reset_pass":
			$view="forgot.php";
			// check if submit or not
			if(empty($_POST['reset_pass'])){
				break;
			}
			
			if(!empty($errors))break;
			
			// perform operation, switching state and view if necessary
			if(!$dbconn){
				$errors[]="Can't connect to db";
				break;
			}
			
			$query = "UPDATE appuser SET password=(CRYPT($2, password)) WHERE userid=$1;";
			$result = pg_prepare($dbconn, "update_pass_query", $query);
			$result = pg_execute($dbconn, "update_pass_query", array($_SESSION['user'], $_POST['newpass']));
			$view="login.php";
			$_SESSION['state'] = 'logout';
			$errors[]="new password set";
			
			break;
			
		case "register":
            $view="register.php";

			// check if submit or not
			if(empty($_POST['submit']) || $_POST['submit']!="Register"){
				break;
			}

			// validate and set errors
			if(!empty($errors))break;

			// perform operation, switching state and view if necessary
			if(!$dbconn){
				$errors[]="Can't connect to db";
				break;
			}

			// check if user exists
			$query = "SELECT * FROM appuser WHERE userid=$1;";
            $result = pg_prepare($dbconn, "login_query", $query);

            $result = pg_execute($dbconn, "login_query", array($_POST['user']));
            if($row = pg_fetch_array($result, NULL, PGSQL_ASSOC)){
				$errors[]="user exists";
			} else { // insert new user
                $query = "INSERT INTO appuser (userid, password, firstname, lastname, email, dob, major, campus, sequ, sequ_ans, gender) VALUES ($1,CRYPT($2, GEN_SALT('bf', 8)),$3,$4,$5,$6,$7,$8,$9,$10,$11);";
				$result = pg_prepare($dbconn, "register_query", $query);
				$result = pg_execute($dbconn, "register_query", array($_POST['user'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['dob'], $_POST['major'], $_POST['campus'], $_POST['sequ'], $_POST['sequ_ans'], $_POST['gender']));

				if($result){
					$rows_affected=pg_affected_rows($result);
					$_SESSION['state'] = 'login';
					$view="login.php";
					$errors[]="user has been registered";
				} else {

				}
			}

			break;

        case "logout":
            //$_SESSION['state'] = 'login';


			session_destroy();
			header("location: index.php");

			/**
			unset($_SESSION['logged_in']);

			unset($_SESSION['user']);

			unset($_SESSION['firstname']);
			unset($_SESSION['lastname']);
			unset($_SESSION['email']);
			unset($_SESSION['major']);
			unset($_SESSION['campus']);
			unset($_SESSION['dob']);

			unset($_SESSION["GuessGame"]);
			unset($_SESSION["FrogGame"]);
			unset($_SESSION["FifteenGame"]);
			**/
            //$view="login.php";
			break;

        case "stats":
            $view="main.php";
			break;

        // fifteen game ----------------------
        case "fifteen":
            if(!isset($_SESSION['SlideGame'])){
                $_SESSION['SlideGame'] = new FifteenGame(0);
            }
            $view="fifteen.php";

			// difficutly
			if(array_key_exists('easy', $_POST)){
			   $_SESSION['SlideGame'] = new FifteenGame(0);
			}
			if(array_key_exists('medium', $_POST)){
			   $_SESSION['SlideGame'] = new FifteenGame(1);
			}
			if(array_key_exists('hard', $_POST)){
			   $_SESSION['SlideGame'] = new FifteenGame(2);
			}
			
            if(isset($_GET['x'])){
                $_SESSION["SlideGame"]->slideTile($_GET['x'], $_GET['y'], false);
                header("location: index.php");
            }
			
			// new game
			if(array_key_exists('new', $_POST)){
			   $_SESSION["SlideGame"]->scrambleGame();
			}

			// store score on database
			if(!$dbconn){
				$errors[]="Can't connect to db";
				break;
			}
			updateScore("SlideGame", $dbconn);

			break;

		// frog game ----------------------
        case "frogs":
			if(!isset($_SESSION['FrogGame'])){
					$_SESSION['FrogGame'] = new FrogGame(0);
			}
            $view="frog.php";

			// difficutly
			if(array_key_exists('easy', $_POST)){
			   $_SESSION['FrogGame'] = new FrogGame(0);
			}
			if(array_key_exists('medium', $_POST)){
			   $_SESSION['FrogGame'] = new FrogGame(1);
			}
			if(array_key_exists('hard', $_POST)){
			   $_SESSION['FrogGame'] = new FrogGame(2);
			}
			
			if(isset($_GET['frog'])){
                $_SESSION["FrogGame"]->jumpFrog($_GET['frog']);
                header("location: index.php");
            }

			// store score on database
			if(!$dbconn){
				$errors[]="Can't connect to db";
				break;
			}
			updateScore("FrogGame", $dbconn);

			// new game
			if(array_key_exists('new', $_POST)){
			   $_SESSION["FrogGame"]->resetGame();
			}

			break;

        // guess game ----------------------
        case "guess":
            if(!isset($_SESSION['GuessGame'])){
                $_SESSION['GuessGame'] = new GuessGame(0);
            }
			$view="guess.php";
			
			// difficutly
			if(array_key_exists('easy', $_POST)){
			   $_SESSION['GuessGame'] = new GuessGame(0);
			}
			if(array_key_exists('medium', $_POST)){
			   $_SESSION['GuessGame'] = new GuessGame(1);
			}
			if(array_key_exists('hard', $_POST)){
			   $_SESSION['GuessGame'] = new GuessGame(2);
			}

			// guess
			if(array_key_exists('guess', $_POST)){
				// check if submit or not
				if(empty($_REQUEST['submit'])||$_REQUEST['submit']!="GUESS"){
					break;
				}

				// validate and set errors
				if(!is_numeric($_REQUEST["guess"]))$errors[]="Guess must be numeric.";
				if(!empty($errors))break;

				// perform operation, switching state and view if necessary
				$_SESSION["GuessGame"]->makeGuess($_REQUEST['guess']);
				$_REQUEST['guess']="";
			}

			// store score on database
			if(!$dbconn){
				$errors[]="Can't connect to db";
				break;
			}
			updateScore("GuessGame", $dbconn);


			// reset game
			if(array_key_exists('restart', $_POST)){
			   $_SESSION["GuessGame"]->resetGame();
			}

			break;
			
		// 2048 game ----------------------
        case "2048":
            if(!isset($_SESSION['2048Game'])){
                $_SESSION['2048Game'] = new TFEGame();
            }
            $view="2048.php";

			// slide
			if(array_key_exists('up', $_POST)){
			   $_SESSION['2048Game']->slideTiles("up");
			}
			if(array_key_exists('down', $_POST)){
			   $_SESSION['2048Game']->slideTiles("down");
			}
			if(array_key_exists('left', $_POST)){
			   $_SESSION['2048Game']->slideTiles("left");
			}
			if(array_key_exists('right', $_POST)){
			   $_SESSION['2048Game']->slideTiles("right");
			}
			
			if(array_key_exists('restart', $_POST)){
			   $_SESSION['2048Game'] =  new TFEGame();
			}
			
			
         

			// store score on database
			if(!$dbconn){
				$errors[]="Can't connect to db";
				break;
			}
			updateScore("2048Game", $dbconn);

			break;
			
		// message board ----------------------
        case "msg":
			$view="msg.php";
			
			// perform operation, switching state and view if necessary
			if(!$dbconn){
				$errors[]="Can't connect to db";
				break;
			}
			
			// validate and set errors
			if(!empty($errors))break;
			
			// get all comments
			$query = "SELECT * FROM msg ORDER BY time DESC;";
            $result = pg_prepare($dbconn, "get_query", $query);

            $result = pg_execute($dbconn, "get_query", array());
            
			$_SESSION['msguser'] = array();
			$_SESSION['msgtext'] = array();
			$_SESSION['msgtime'] = array();
			while ($row = pg_fetch_array($result)) {
				array_push($_SESSION['msguser'], $row['userid']);
				array_push($_SESSION['msgtext'], $row['text']);
				array_push($_SESSION['msgtime'], $row['time']);
			}
			
			// check if submit or not
			if(empty($_POST['submit'])){
				break;
			}

			
			$query = "INSERT INTO msg (userid, text, time) VALUES ($1,$2, current_date);";
			$result = pg_prepare($dbconn, "msg_query", $query);
			$result = pg_execute($dbconn, "msg_query", array($_SESSION['user'], $_POST['msg']));
			

			
			break;
		
		
	}

	function updateScore($gameid, $dbconn) {
		if ($_SESSION[$gameid]->msg == "YOU WIN!" || $_SESSION[$gameid]->msg == "YOU LOSE!") {

			// check if user exists
			$query = "SELECT * FROM scores WHERE gameid=$1 and userid=$2 and difficulty=$3;";
			$result = pg_prepare($dbconn, "score_check_query", $query);

			$result = pg_execute($dbconn, "score_check_query", array($gameid, $_SESSION['user'], $_SESSION[$gameid]->hard));
			if($row = pg_fetch_array($result, NULL, PGSQL_ASSOC)){ // update score
				//$errors[]="user exists";
				if ($row["score"] < $_SESSION[$gameid]->moves) {

					//echo($row["score"]);
					$query = "UPDATE scores SET score=$3 WHERE gameid=$1 and userid=$2 and difficulty=$4;";
					$result = pg_prepare($dbconn, "update_score_query", $query);
					$result = pg_execute($dbconn, "update_score_query", array($gameid, $_SESSION['user'], $_SESSION[$gameid]->moves, $_SESSION[$gameid]->hard));
				}
			} else { // insert new score
				$query = "INSERT INTO scores (gameid, userid, score, difficulty) VALUES ($1, $2, $3, $4);";
				$result = pg_prepare($dbconn, "add_score_query", $query);
				$result = pg_execute($dbconn, "add_score_query", array($gameid, $_SESSION['user'], $_SESSION[$gameid]->moves, $_SESSION[$gameid]->hard));

				if($result){
					$rows_affected=pg_affected_rows($result);
					//$errors[]="user has been registered";
				} else {

				}
			}
		}
	}



	require_once "view/$view";
?>
