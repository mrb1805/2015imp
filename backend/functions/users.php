<?php
/*

function UserAgent() {
$useragent = $_SERVER['HTTP_USER_AGENT'];
$UserAgentEx = explode(" ",$useragent);
	if (isset($_GET['agent']) == 'iphone' && $UserAgentEx[4] === 'iPhone' || $UserAgentEx[1] === '(iPhone;') {
		return 'iPhone';
	} else if (isset($_GET['agent']) == 'android' && $UserAgentEx[4] === 'Android') || $UserAgentEx[3] === 'Android'){
		return 'Android';
	} else if ($UserAgentEx[4] === '(iPad;'){
		return 'iPad';
	} else if ($UserAgentEx[2] === 'MSIE' || $UserAgentEx[2] === 'NT' ||  $UserAgentEx[2] === 'Mac' ||  $UserAgentEx[3] === 'Windows'){
		return 'Not Mobile';
	} else {
		foreach ($UserAgentEx as $value) {
			echo "Value: $value<br />\n";
		}
		return 'Mobile';
	}
} 
*/

function is_admin($user_id) {
	$user_id = (int)$user_id;
	return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `user_id` = '$user_id' AND `type` =1"), 0) == 1) ? true : false;
}

function recover($mode, $email) {
	$mode = sanitize($mode); 
	$email = sanitize($email);
	
	$user_data = user_data(user_id_from_email($email), 'first_name', 'username', 'user_id');

	if ($mode == 'username') {
		email($email, 'Your Username Recovery', "Hello " . $user_data['first_name'] . ",\n\nYour username is:" . $user_data['username'] . "\n\n -Postwave");
	} else if ($mode == 'password'){
		$generated_password = substr(encrypt(rand(999, 999999)), 0 , 8);
		change_password($user_data['user_id'], $generated_password);
		update_user($user_data['user_id'], array('password_recover' => '1'));
		email($email, 'Your Password Recovery', "Hello " . $user_data['first_name'] . ",\n\nYour new password is:" . $generated_password . ".\n\n When you login you can change your password using the change password buttion.\n\n -Postwave");
	}
}

function activate($email, $email_code){
	$email		= mysql_real_escape_string($email);
	$email_code	= mysql_real_escape_string($email_code);
	
	if (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email' AND '$email_code' AND `active` =0"), 0) == 1) {
		mysql_query("UPDATE `users` SET `active` = 1 WHERE `email` = '$email'");
		return true;
	} else {
		return false;
	}
}

function update_user($session_user_id, $update_data) {
	$update = array();
	array_walk($update_data, 'array_sanitize');
	
	foreach($update_data as $field=>$data) {
		$update[] = '`' . $field . '` = \'' . $data . '\'';
	}
	 mysql_query("UPDATE `users` SET " . implode(', ', $update) . " WHERE `user_id` = $session_user_id");
}

function change_password($user_id, $password) {
	$user_id = (int)$user_id;
	$password = encrypt($password);
	mysql_query("UPDATE `users` SET `password` = '$password', `password_recover` = 0 WHERE `user_id` = $user_id");
}

function register_user($register_data) {
	array_walk($register_data, 'array_sanitize');
	
	
	
	$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
	$data = '\'' . implode('\', \'',$register_data) . '\'';
	
	mysql_query("INSERT INTO `users` ($fields) VALUES ($data)");
	email($register_data['email'], 'Activate Your Postwave Account', "
	Hello " . $register_data['first_name'] . ",\n\nYou need to activate your account to use Postwave ,Use this link below:\n\nhttp://kossy.co.cc/postwave/activate.php?email=" . $register_data['email'] . "&email_code=" . $register_data['email_code'] . "\n\n -Postwave");
}

function user_data($user_id) {
	$data = array();
	$user_id = (int)$user_id;
	
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	
	
	if ($func_num_args > 1) {
		unset($func_get_args[0]);

		$fields = '`' . implode('`, `', $func_get_args) . '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `users` WHERE `user_id` = $user_id"));	

		return $data;
	}

}
	
function user_count() {
	return mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `active` = 1"), 0);
}

function user_count_admin() {
	return mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `type` = 1"), 0);
}

function user_count_all() {
	return mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users`"), 0);
}

function user_exists($username) {
	$username = sanitize($username); 
	return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username'"), 0) == 1) ? true : false;
}

function email_exists($email) {
	$username = sanitize($email); 
	return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email'"), 0) == 1) ? true : false;
}

function user_active($username) {
	$username = sanitize($username);
	$query2 = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `active` = 1 ");
	return (mysql_result($query2, 0) == 1) ? true : false;
}

function user_id_from_username($username) {
	$username = sanitize($username);
	return mysql_result(mysql_query("SELECT `user_id` FROM `users` WHERE `username` = '$username'"), 0, 'user_id');
	
}

function user_id_from_email($email) {
	$username = sanitize($email);
	return mysql_result(mysql_query("SELECT `user_id` FROM `users` WHERE `email` = '$email'"), 0, 'user_id');
	
}
function login($username, $password) {
	$user_id = user_id_from_username($username);
	
	$username = sanitize($username);
	$password = encrypt($password);
										
	return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `password` = '$password'"), 0) == 1) ? $user_id : false;
}
function logged_in() {
	return (isset($_SESSION['user_id'])) ? true : false;
}

?>