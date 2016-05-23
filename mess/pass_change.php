<?php
session_start();
if(!$_SESSION['varname'])
	die("cannot connect to database");
if(!mysql_connect("localhost", "root", "")) 
  die("cannot connect to database"); 

if(!mysql_select_db("mess"))
 die ("can't connect to database");

if(isset($_POST["n_pass"]))
{
	$passwd=$_POST["n_pass"];
	$username=$_SESSION['varname'];
	if($_POST["n_pass"]==$_POST["n_pass2"]){
		mysql_query("UPDATE  `mess`.`getin` SET  `password` =  $passwd WHERE  `getin`.`loginid` =  $username");
		echo "Password changed successfully";
	}
	else{
		echo "!!!!Password do not match!!!!";
	}
}
?>
<html>
		<fieldset>
		<legend>Change Password</legend>
		<form action="pass_change.php"  method="post"> 
		<p>Enter New Password:  <input type="password" name="n_pass" size="15"    maxlength="30" /> </p> 
		<p>Re-Enter New Password:  <input type="password" name="n_pass2" size="15"    maxlength="30" /> </p> 
		<p><input type="submit"    value="Save" /> </p></form> 
		</fieldset>
		

<a href=login.php>Go Back</a><br/>
<a href=logout.php>Logout</a>
</html>

