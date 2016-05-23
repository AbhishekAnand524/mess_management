<?php
session_start();
if(!$_SESSION['varname'])
	die("cannot connect to database");

if(!mysql_connect("localhost", "root", "")) 
  die("cannot connect to database"); 

if(!mysql_select_db("mess"))
 die ("can't connect to database");

$username=$_SESSION['varname'];
$query = "SELECT * FROM meal_chart1"; 
$result = mysql_query($query);

echo "<table>"; // start a table tag in the HTML

while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
echo "<tr><td>" . $row['date'] . "</td><td> </td><td>" . $row[$username] . "</td></tr>";  //$row['index'] the index here is a field name
}

echo "</table>"; //Close the table in HTML

mysql_close();
?>
<a href=logout.php>Logout</a> <br/>
<a href=login.php>Go Back</a>

