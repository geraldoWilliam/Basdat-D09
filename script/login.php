<?php
require "../connectDB.php";
// db connect; please adjust the db connection. it's outside the project directory.
// misc
$usernameErrorMsg = "";
$passwordErrorMsg = "";
$attemptUsername = "";
$withPass ="";
function loadLoginForm() {
	$action = htmlspecialchars ( $_SERVER ['PHP_SELF'] );
	$LoginFormHtml = "
		<section id='form-signin'>
		<header>
		<h3>Log in</h3>
		</header>
		<form id='LoginForm' class='form-signin' method='POST' action='$action'>
		<label id='sr-only'>Username:</label>
		<input class='form-control' id='LoginUsernameField' type='text' name='username' placeholder='Username'>
		<span class='requiredForm'>" . $usernameErrorMsg . "</span>
  <br>
	<label id='sr-only'>Password:</label> <input class='form-control' id='LoginPasswordField' type='password' name='password' placeholder='Password'><span class='requiredForm'>" . $passwordErrorMsg . "</span><br>
	<input class='btn btn-lg button-primary btn-block' id='LoginSubmitButton' type='submit' value='Log In' name='login'>
	</form>
	</section>
	";
	echo $LoginFormHtml;
}
function redirectGuest() {
	if (! isset ( $_SESSION ["ActiveUser"] )) {
		header ( 'Location: index.php' );
	}
}
function redirectUser() {
	if (isset ( $_SESSION ["ActiveUser"] )) {
		loadPanelPage();
	}
}
function loadPanelPage(){
	header( 'Location : profile.php');
	//todo
}
function loginDummy() {
	// header ('Location: Inventori/');
	if (isset ( $_SESSION ["loggedUser"] )) {
		$_SESSION ["loggedUser"] = "dummy";
		header ( 'Location: /booking/lihat/index.php' );
	}
	if ($_SESSION ["ActiveUser"]!="" ) {
		
		header ( 'Location: booking/lihat/index.php' );
	}
}
function loadLoginDummy() {
	GLOBAL $usernameErrorMsg, $passwordErrorMsg;
	$action = htmlspecialchars ( $_SERVER ['PHP_SELF'] );
	$LoginFormDummy = "
  <div class='one-half column' style='margin: 5% 0%'>
	<form id='LoginForm' class='form-signin u-full-width' method='POST' action='$action'>
	<label id='sr-only'>Username:</label>
  <input class='form-control u-full-width' id='LoginUsernameField' type='text' name='username' placeholder='Username'><span class='requiredForm'>" . $usernameErrorMsg . "</span>
	<label id='sr-only'>Password:</label>
  <input class='form-control u-full-width' id='LoginPasswordField' type='password' name='password' placeholder='Password'><span class='requiredForm'>" . $passwordErrorMsg . "</span>
	<input class='btn btn-lg button-primary' id='LoginSubmitButton' type='submit' value='Log In' name='login'>
	</form>
  </div>
	";
	echo $LoginFormDummy;
}
function authenticate() {
	GLOBAL $conn, $usernameErrorMsg, $passwordErrorMsg, $attemptUsername, $withPass;
	$conn=Connectpgdb ();
	$attemptUsername = $_POST ["username"];
	$withPass = $_POST ["password"];
	$loginQuery = "Select * from silutel.user where email='$attemptUsername' and password='$withPass' ";
	
	$results = pg_query ( $conn, $loginQuery );
	if (pg_num_rows ( $results ) > 0) {
		$row= pg_fetch_row ( $results );
			$_SESSION ["ActiveUser"] = $row[0];
			$_SESSION ["Role"] = $row[3];
			//redirectUser (); please implement load panel page
			loginDummy();
			echo "<script language='javascript'> alert('Logged in!')</script>";
	} else {
		$searchUser = "Select * from silutel.user where email='$attemptUsername'";
		$result2 = pg_query ( $conn, $searchUser );
		if (pg_num_rows ( $result2 ) > 0) {
			$passwordErrorMsg = "Invalid Password";
		} else {
			$usernameErrorMsg = "Invalid Username";
			
		}
	}
	pg_close ( $conn );
}

?>