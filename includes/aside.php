<aside>
	<?php 
	global $session_user_id;
	if (logged_in() === true){
		include 'includes/widgets/loggedin.php';
	} else {
		include 'includes/widgets/login.php';
		include 'includes/widgets/tidl.php';
	}
	
	if (logged_in() === false){
		include 'includes/widgets/user_count.php';
	}else if (logged_in() === true && is_admin($session_user_id) === false) {
		include 'includes/widgets/user_count.php';
	}else if (logged_in() === true && is_admin($session_user_id) === true) {
		include 'includes/widgets/admin_user_count.php';
	}
	?>
</aside>