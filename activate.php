<?php
include 'backend/init.php';
protect_page_login();
include 'includes/overall/header.php';
if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
?>
	<h2>Thanks, we've activated your account ...</h2>
	<p>Login, to use the great features of Postwave now!</p>
<?php
} else if (isset($_GET['email'], $_GET['email_code']) === true){

	$email 		= trim($_GET['email']);
	$email_code = trim($_GET['email_code']);
	
	if (email_exists($email) === false) {
		$errors[] = 'Email No Found';
	} else if (activate($email, $email_code) === false) {
		$errors[] = 'We had problems activating your account.';
	}
	
	if (empty($errors) === false){
	?>
		<h2>Oops...</h2>
	<?php
		echo output_errors($errors);
	} else {
		header('Location: activate.php?success');
		exit();
	}
	
} else {
	header ('Location: index.php');
	exit();
}


include 'includes/overall/footer.php';
?>
