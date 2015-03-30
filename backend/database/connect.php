<?php
$connect_error = 'Sorry we are having connection Problems , We suggest googling kittys while you wait for us to fix the issue';
mysql_connect('localhost','root','passwordhere') or die ($connect_error);
mysql_select_db('postwave') or die ($connect_error);

?>