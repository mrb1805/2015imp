<?php
include 'backend/init.php';
protect_page();
admin_protect();
include 'includes/overall/header.php';
?>

<h1>Admin Panel</h1>
<p>Admin Stuffs go here.</p>
<h2><u>User Types</u></h2>

<form action="" method="post">
	<ul>
		<li>
			Normal User:<br>
			<input type="text" name="normal_type" value="<?php echo $user_data['first_name']; ?>">
		</li>
		<li>
			Staff:<br>
			<input type="text" name="last_name" value="<?php echo $user_data['last_name']; ?>">
		</li>
		<li>
			Admins:<br>
			<input type="text" name="email" value="<?php echo $user_data['email']; ?>">
		</li>
		<li>
			<input type="submit" value="Update">
		</li>
	</ul>
</form>
<?php include 'includes/overall/footer.php' ?>
