<?php 
include 'backend/init.php';
protect_page_login();
$marks = '0';
include 'includes/overall/header.php'; 


//Processing Form Data.
				
	$required_fields = array('username', 'password', 'password_again', 'first_name', 'email'); //Checking Required Fields
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key , $required_fields) === true){
			$errors[] = 'Fields marked with an [*] are required .... Try again.';
			$marks = '1';
			break 1;
		}
	} /*
	if (empty($errors) === true) {
		if (user_exists($_POST['username']) === true) {
			$errors[] ='Sorry, the username \'' . htmlentities($_POST['username']) . '\' is already taken.';
		}
		if (preg_match("/\\s/", $_POST['username']) == true) {
			$errors[] = 'Your username must not contain spaces';
		}
		if (strlen($_POST['password']) <= 6 ) {
			$errors[] = 'Your Password must be more than 6 characters';
		}
		if ($_POST['password'] !== $_POST['password2']){
			$errors[] = 'Your Password do not match';
		}
		if ($_POST['username'] == $_POST['password']){
			$errors[] = 'Your Username and Password can not be the same';			
		}
		if ($_POST['username'] == 'password' || 'username' || 'admin' || 'root'){
			$errors[] = 'Invaild Username';			
		}
		if ($_POST['password'] == 'password' || 'Password') {
			$errors[] = 'Your Password can not Password';			
		}
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = 'A vaild email address is required';
		}
		if (email_exists($_POST['email']) === true) {
			$errors[] = 'Sorry, the email \'' . $_POST['email'] . '\' is already in use.';
		}
	}
*/
	

?>
<h1>Register</h1>
<?php
if (isset($_GET['success']) && empty($_GET['success'])) {
	echo 'You\'ve been registered successfully! Please check you email.';
} else {
	if (empty($_POST) === false && empty($errors) === true) { 
		$register_data = array(
			'username' 		=> $_POST['username'],
			'password' 		=> encrypt($_POST['password']),
			'first_name' 	=> $_POST['first_name'],
			'last_name' 	=> $_POST['last_name'],
			'email' 		=> $_POST['email'],
			'email_code'    => md5($_POST['username'] + microtime())
		);
	
		register_user($register_data);

		header('Location: register.php?success');
		exit();
		
	} else if (empty($errors) === false){
		echo output_errors($errors);
				
}

?>


<form action=" " method="post">
	<ul>
		<li>
			Username:<br>
			<input type="text" name="username">
			<?php requiremark($marks); ?>	
		</li>
		<li>

			Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Repeat Password:<br>
			<input type="password" name="password"> - <input type="password" name="password2">
			<?php requiremark($marks); ?>	
		</li>

		<li>
			*First Name:<br>
			<input type="text" name="first_name">
			<?php requiremark($marks); ?>
		</li>
		<li>
			Last Name:<br>
			<input type="text" name="last_name">
		</li>
		<li>
		<br>
			Email:<br>
			<input type="text" name="email">
			<?php requiremark($marks); ?>
		</li>
		
		<p></p>
		
		

		<li>
			<input type="submit" value="Register">
		</li>
	</ul>
</form>
<?php 
}
include 'includes/overall/footer.php'; 

?>