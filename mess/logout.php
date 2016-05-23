<?php
session_start();
$loginid=$_SESSION['varname'];
if(!$loginid)
	die("Sorry Something went wrong");
echo 'Logged out successfully!';
session_destroy();
?>
<br/>
<a href="index.html">Go back to Log In page</a>