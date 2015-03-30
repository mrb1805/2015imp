<?php 
include 'backend/init.php';
protect_page();
include 'includes/overall/header.php'; 
?>
<h1>Account</h1>
<ul>
    <li><h3>Networking</h3></li>
    <li><a href="account.php?api=facebook">Facebook</a></li>
	<li><a href="account.php?api=twitter">Twitter</a></li>
	<li><a href="account.php?api=googleplus">Google+</a></li>
	<li><a href="account.php?api=myspace">MySpace</a></li>
	<li><h3>Mutimedia</h3></li>
	<li><a href="account.php?api=imgur">Imgur</a></li>
	<li><a href="account.php?api=imgshack">Imgshack</a></li>
    <li><a href="account.php?api=facebook">Stuffs</a></li>
</ul>


<?php include 'includes/overall/footer.php' ?>
