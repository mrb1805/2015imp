<?php 
include 'backend/init.php';
protect_page_login();
include 'includes/overall/header.php';
?>
<?php

//Username Recovery Title Set
if (($_GET['mode']) === 'username') {
?>
<h2>Recover Username</h2>
<?php
}

//Password Recovery Title Set
if (($_GET['mode']) === 'password') {
?>
<h2>Recover Password<img src="content/images/Icon_Padlock.png" alt="Logo" height="20" width="25" /></h2>
<?php
}
if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
?>
<p> We Have Emailed you your recovered item.</p>
<?php
} else {
	$mode_allowed = array('username', 'password');
	if (isset($_GET['mode']) === true && in_array($_GET['mode'], $mode_allowed) === true) {
		if (isset($_POST['email']) === true && empty($_POST['email']) === false){
			if (email_exists($_POST['email']) === true) {
				recover($_GET['mode'],$_POST['email']);
				header('Location: recover.php?success');
				exit();
			} else {
				echo '<p>We could not find that email adresss</p>';
			}
		}
?>
	<form action "" method="post">
		<ul>
			<li>
				Please enter your email address:<br>
				<input type="text" name="email">
			</li>
			<li><input type="submit" value="Recover"></li>
		</ul>
	</form>
<?php
	} else {
		header('Location: index.php');
		exit();
	}
}
?>

<?php include 'includes/overall/footer.php' ?>
