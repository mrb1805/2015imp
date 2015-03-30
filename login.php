<?php
include 'backend/init.php';
protect_page_login();
if (empty($_POST) === false) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	
	if (empty($username) === true || empty($password) === true)  {
		$errors[] = 'You need to enter a Username and Password';
    } else if (user_exists($username) === false) {
		$errors[] = 'Username does not exsist';
	} else if (user_active($username) === false){
		$errors[] = 'You haven\'t activated you account , Check you email';	  
	} else if (strlen($password) > 32) {
		$errors[] ='Password length to long';
	}else{
	   $login = login($username, $password);
	   if ($login === false) {
			$errors[] = 'Login failed, invaild combination';
		} else {
			$_SESSION['user_id'] = $login;
			header('Location: index.php');				
		}
	}
} else {
	$errors[] = 'No data received.';
}
include 'includes/overall/header.php';	
if (empty($errors) === false) {
?>
	<h2>We tried to log you in, but....</h2>
<?php
	echo output_errors($errors);
}
include 'includes/overall/footer.php';
?>