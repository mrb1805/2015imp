<?php 
include 'backend/init.php' ;
protect_page();
include 'includes/overall/header.php'; 

if (empty($_POST) === false) {
	$required_fields = array('first_name', 'email'); //Checking Required Fields
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key , $required_fields) === true){
			$errors[] = 'Fields marked with an * are required .... Try again';
			break 1;
		}
	}
	 if (empty($errors) === true) {
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = 'A vaild email address is required';
		} else if (email_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email']) {
			$errors[] = 'Sorry, the email \'' . $_POST['email'] . '\' is already in use.';
		}
	
	}

}
?>

<h1>Update Profile Info</h1>
<?php
if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
	echo 'You\'ve updated your profile successfully!';
}else {
	if (empty($_POST) === false && empty($errors) === true) {
		$update_data = array(
			'first_name' 	=> $_POST['first_name'],
			'last_name' 	=> $_POST['last_name'],
			'email' 		=> $_POST['email']
		);
		
		update_user($session_user_id, $update_data);
		header('Location: profile_settings.php?success'); //Posted form no errors
		exit ();
	}  else if(empty($errors) === false){
		echo output_errors($errors);		//output errors
	}
?>

<form action="" method="post">
	<ul>
		<li>
			*First Name:<br>
			<input type="text" name="first_name" value="<?php echo $user_data['first_name']; ?>">
		</li>
		<li>
			Last Name:<br>
			<input type="text" name="last_name" value="<?php echo $user_data['last_name']; ?>">
		</li>
		<li>
			*Email:<br>
			<input type="text" name="email" value="<?php echo $user_data['email']; ?>">
		</li>
		<li>
			<input type="submit" value="Update">
		</li>
	</ul>
</form>
<?php 
}
include 'includes/overall/footer.php';
?>
