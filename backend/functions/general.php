<?php
function requiremark($marks){
	if ($marks == '1'){
	?>
	<font color="#FF0000">&nbsp;&nbsp;&nbsp;[*]</font>
	
<?php

 }
}

function admin_protect(){
	global $user_data;
	if (is_admin($user_data['user_id']) === false) {
		header('Location: index.php');
		exit();
	}
}
/*
function userdevice() { // agent in array pass to function . spare time? . for each loop?
	if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod')){
		header('Location: http://postwave.co/dev/mobile.php?agent=iphone');
		exit();
	}else if (strstr($_SERVER['HTTP_USER_AGENT'],'Android')){
	    header('Location: http://postwave.co/dev/mobile.php?agent=android');
		exit();
	}else if (strstr($_SERVER['HTTP_USER_AGENT'],'hp-tablet') || strstr($_SERVER['HTTP_USER_AGENT'],'PlayBook') || strstr($_SERVER['HTTP_USER_AGENT'],'PDA') || strstr($_SERVER['HTTP_USER_AGENT'],'PSP')){
	    header('Location: http://postwave.co/dev/mobile.php?agent=mobile');
		exit();
	}
}
*/
function encrypt($password){
	//$salt = 'd4017948438805dd3371c02706bcc36864a836c920c99100262a47502ac41859923c0c343f86412b0cdb5eb9115bc68708f6d2055ffd19d591edaa1d309bb064';
	//hash("sha512" ,$password);
	$boop = sha1($password);
	return $boop;

}

function email($to, $subject, $body){
	mail($to, $subject, $body, 'From: noreply@postwave.co.cc');	
}

function nav_logged() {
	global $user_data;
	if (logged_in() === true && is_admin($user_data['user_id']) == 0) {
		include 'includes/loggednav.php';
	}else if (logged_in() === true && is_admin($user_data['user_id']) == 1){
	include 'includes/adminnav.php';
	}else{
	include 'includes/nav.php';
	}
}

function protect_page_login() {
	if (logged_in() === true) {
	 header('Location: index.php');
	 exit();
	}	
}

function protect_page() {
	if (logged_in() === false) {
	 header('Location: nologin.php');
	 exit();
	}	
}

function array_sanitize (&$item) {
	$item = mysql_real_escape_string($item);
}

function sanitize ($data) {
	return mysql_real_escape_string($data);
}

function output_errors($errors) {
	$output = array();
	foreach($errors as $error) {
		$output[] = '<li>' . $error . '</li>';
	}
	return '<ul>' . implode('', $output) . '</ul>';
}

?>