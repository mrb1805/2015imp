<?php 
include 'backend/init.php' ;
protect_page();

if (empty($_POST) === false) {
	$required_fields = array('current_password', 'password', 'password_again'); //Checking Required Fields
	foreach($_POST as $key=>$value) { 											//Required Fields filled?
		if (empty($value) && in_array($key , $required_fields) === true){
			$errors[] = 'Fields marked with an * are required .... Try again';
			break 1;
		}
	}	
	if (encrypt($_POST['current_password']) === $user_data['password']) {
		if (trim($_POST['password']) !== trim($_POST['password_again'])) {
			$errors[] ='New password does not match';		
		} else if (strlen($_POST['password']) < 6){	
			$errors[] ='Password must be at least 6 characters';
		}
	} else{
		$errors[] = 'Your Current password is incorrect';
		
	}
	
	
}

include 'includes/overall/header.php'; 
?>

<h1>Change Password</h1>
<?php
if (isset($_GET['success'])=== true && empty($_GET['success']) === true) {
	echo 'You\'ve changed your password successfully!"';
}else {
	
	if (isset($_GET['force'])=== true && empty($_GET['force']) === true){
	?>
		<p> You Must Change your password after recovery</p>
	<?php
	}
	
	
	if (empty($_POST) === false && empty($errors) === true) {
		change_password($session_user_id, $_POST['password']);
		header('Location: change_password.php?success');	//Posted form no errors
	}  else if(empty($errors) === false){
		echo output_errors($errors);		//output errors
	}
?>

<form action="" method="post">
	<ul>
		<li>
			*Current Password:<br>
			<input type="password" name="current_password">
		</li>
		<li>
			*New Password:<br>
			<input type="password" name="password">
		</li>
		<li>
			*Confirm New Password:<br>
			<input type="password" name="password_again">
		</li>
		<li>
			<input type="submit" value="Change Password">
		</li>
	</ul>
</form>
<?php 
}
include 'includes/overall/footer.php';
?>
