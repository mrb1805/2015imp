<!DOCTYPE html>
<?php
require 'backend/functions/users.php'; 
require 'backend/functions/general.php';
?>
<html>
<head>
<script type="text/javascript">
<!--
function redirect()
{
window.location = "http://www.google.com/"
}
//-->

</script>
</head>
<body>
<form method="post">
<h1>Hi ,Theres a  version of Postwave do you want to use it?</h1>
<?php
echo UserAgent();
?>
<input type="submit" value="Yes, go to mobile version"  onclick="WriteCookie();"/>
<input type="submit" value="No, go to main site"  onclick="redirect();"/>
</form>
</body>
</html>



