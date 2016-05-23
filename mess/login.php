<?php
session_start();
$username=$_POST["username"]; 
$password=$_POST["password"];

if(!$username){
	$username=$_SESSION['varname'];
	$password=$_SESSION['password']; }
	
if(!$username)
	die("cannot connect to database");

if(!mysql_connect("localhost", "root", "")) 
  die("cannot connect to database"); 

if(!mysql_select_db("mess"))
 die ("can't connect to database");



$result=mysql_query("select * FROM getin WHERE loginid='$username'");

$row=mysql_fetch_array($result);


if($row["loginid"]==$username && $row["password"]==$password) 
{
	
	echo '<h4>Welcome '.$row["name"].'</h4>';
	echo 'User ID:'.$username;
	echo '<br/>';
	echo date('j M Y, H:i:s');
	
}
else
{	
	echo 'Invalid Password';
	exit(0);
}

$_SESSION['varname']=$username;
$_SESSION['password']=$password;


?>
<head><title>Welcome</title></head>
<body><br/><br/>
	    
</body>


  <form method="post" action="login.php">
		
		<p>Pick a Date: 
		<select name="day1">    
			<option value="1">01</option>    
			<option value="2">02</option>    
			<option value="3">03</option>
			<option value="4">04</option>
			<option value="5">05</option>
			<option value="6">06</option>
			<option value="7">07</option>
			<option value="8">08</option>
			<option value="9">09</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
			<option value="23">23</option>
			<option value="24">24</option>
			<option value="25">25</option>
			<option value="26">26</option>
			<option value="27">27</option>
			<option value="28">28</option>
			<option value="29">29</option>
			<option value="30">30</option>
			<option value="31">31</option>
			</select> 
			<select name="month1">    
			<option value="1">Jan</option>
			<option value="2">Feb</option>
			<option value="3">Mar</option>
			<option value="4">Apr</option>
			<option value="5">May</option>
			<option value="6">June</option>
			<option value="7">July</option>
			<option value="8">Aug</option>
			<option value="9">Sept</option>
			<option value="10">Oct</option>
			<option value="11">Nov</option>
			<option value="12">Dec</option></select>
			</p>

		<p>Please select your option for Day:  <br />   
		<input type="radio" name="day_food" value="0"     checked="checked" /> Off   
		<input type="radio" name="day_food" value="v" />   Veg   
		<input type="radio" name="day_food" value="n" />  Non-Veg </p> 
		
		
		<p>Please select your option for Night:  <br />   
		<input type="radio" name="night_food" value="0"     checked="checked" /> Off   
		<input type="radio" name="night_food" value="v" />   Veg   
		<input type="radio" name="night_food" value="n" />  Non-Veg </p> 
		<input type="submit" value="Submit">  
		<br/>
	</form>
		
		<br/>
  </body>
</html>
<?php $day1=$_POST["day1"];
$month1=$_POST["month1"];
$food_day=$_POST["day_food"];
$food_night=$_POST["night_food"];
$present_day1=date('j');
$present_month1=date('m');
$present_year1=date('y');
$present_hour1=date('H');
$c=0;
if($day1&&$month1)
{
	$result1=mysql_query("SELECT * FROM `mess`.`meal_chart1` WHERE `date`='$day1/$month1/d'");
	$result2=mysql_query("SELECT * FROM `mess`.`meal_chart1` WHERE `date`='$day1/$month1/n'");
	if($month1==$present_month1 && $day1>$present_day1) 
		{
			echo ' For ';
			echo $day1;
			echo '/';
			echo $month1;
			echo '/';
			echo $present_year1;
			echo ' Your meal has been successfully updated as: ';
			if(!$food_day)
			{
				echo 'Day: Off';
				if (mysql_fetch_array($result1, 0) > 0) 
				{
					mysql_query("UPDATE  `mess`.`meal_chart1` SET  `$username` =  'off' WHERE `meal_chart1`.`date` = '$day1/$month1/d'") ;
				}
				else
				{
					mysql_query("INSERT INTO `mess`.`meal_chart1` (`date`, `$username`) VALUES ('$day1/$month1/d', 'off')");
				}
			}
			if($food_day=='v')
			{
				echo 'Day: Veg';
				if (mysql_fetch_array($result1, 0) > 0) 
				{
					mysql_query("UPDATE  `mess`.`meal_chart1` SET  `$username` =  'v' WHERE `meal_chart1`.`date` = '$day1/$month1/d'") ;
				}
				else
				{
					mysql_query("INSERT INTO `mess`.`meal_chart1` (`date`, `$username`) VALUES ('$day1/$month1/d', 'v')");
				}
			}
			if($food_day=='n')
			{
				echo 'Day: Non Veg';
				if (mysql_fetch_array($result1, 0) > 0) 
				{
					mysql_query("UPDATE  `mess`.`meal_chart1` SET  `$username` =  'nv' WHERE `meal_chart1`.`date` = '$day1/$month1/d'") ;
				}
				else
				{				
					mysql_query("INSERT INTO `mess`.`meal_chart1` (`date`, `$username`) VALUES ('$day1/$month1/d', 'nv')");
				}
			}
			if(!$food_night)
			{	echo ' & Night: Off';
				if (mysql_fetch_array($result2, 0) > 0) 
				{
					mysql_query("UPDATE  `mess`.`meal_chart1` SET  `$username` =  'off' WHERE `meal_chart1`.`date` = '$day1/$month1/n'") ;
				}
				else
				{
					mysql_query("INSERT INTO `mess`.`meal_chart1` (`date`, `$username`) VALUES ('$day1/$month1/n', 'off')");
				}
			}
			if($food_night=='v')
			{
				echo ' & Night: Veg';
				if (mysql_fetch_array($result2, 0) > 0) 
				{
					mysql_query("UPDATE  `mess`.`meal_chart1` SET  `$username` =  'v' WHERE `meal_chart1`.`date` = '$day1/$month1/n'") ;
				}
				else
				{
					mysql_query("INSERT INTO `mess`.`meal_chart1` (`date`, `$username`) VALUES ('$day1/$month1/n', 'v')");
				}
			}
			
			if($food_night=='n')
			{
				echo ' & Night: Non Veg';
				if (mysql_fetch_array($result2, 0) > 0) 
				{
					mysql_query("UPDATE  `mess`.`meal_chart1` SET  `$username` =  'nv' WHERE `meal_chart1`.`date` = '$day1/$month1/n'") ;
				}
				else
				{
					mysql_query("INSERT INTO `mess`.`meal_chart1` (`date`, `$username`) VALUES ('$day1/$month1/n', 'nv')");
				}
			}
			echo  nl2br("\n");
			
			} 


		else if($month1==$present_month1+1 && $day1<$present_day1) 
			{
				if (mysql_query("SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'mess' AND TABLE_NAME = 'meal_chart' AND COLUMN_NAME = ' '"))
			{
					mysql_query("ALTER TABLE  `meal_chart` ADD `$day1/$month1/d` VARCHAR( 255 ) NULL");
					mysql_query("ALTER TABLE  `meal_chart` ADD `$day1/$month1/n` VARCHAR( 255 ) NULL");
			}
			echo ' For ';
			echo $day1;
			echo '/';
			echo $month1;
			echo '/';
			echo $present_year1;
			echo ' your meal has been successfully updated as: ';
			if(!$food_day)
			{
				echo 'Day: Off';
				if (mysql_fetch_array($result1, 0) > 0) 
				{
					mysql_query("UPDATE  `mess`.`meal_chart1` SET  `$username` =  'off' WHERE `meal_chart1`.`date` = '$day1/$month1/d'") ;
				}
				else
				{
					mysql_query("INSERT INTO `mess`.`meal_chart1` (`date`, `$username`) VALUES ('$day1/$month1/d', 'off')");
				}
			}
			if($food_day=='v')
			{
				echo 'Day: Veg';
				if (mysql_fetch_array($result1, 0) > 0) 
				{
					mysql_query("UPDATE  `mess`.`meal_chart1` SET  `$username` =  'v' WHERE `meal_chart1`.`date` = '$day1/$month1/d'") ;
				}
				else
				{
					mysql_query("INSERT INTO `mess`.`meal_chart1` (`date`, `$username`) VALUES ('$day1/$month1/d', 'v')");
				}
			}
			if($food_day=='n')
			{
				echo 'Day: Non Veg';
				if (mysql_fetch_array($result1, 0) > 0) 
				{
					mysql_query("UPDATE  `mess`.`meal_chart1` SET  `$username` =  'nv' WHERE `meal_chart1`.`date` = '$day1/$month1/d'") ;
				}
				else
				{				
					mysql_query("INSERT INTO `mess`.`meal_chart1` (`date`, `$username`) VALUES ('$day1/$month1/d', 'nv')");
				}
			}
			if(!$food_night)
			{	echo ' & Night: Off';
				if (mysql_fetch_array($result2, 0) > 0) 
				{
					mysql_query("UPDATE  `mess`.`meal_chart1` SET  `$username` =  'off' WHERE `meal_chart1`.`date` = '$day1/$month1/n'") ;
				}
				else
				{
					mysql_query("INSERT INTO `mess`.`meal_chart1` (`date`, `$username`) VALUES ('$day1/$month1/n', 'off')");
				}
			}
			if($food_night=='v')
			{
				echo ' & Night: Veg';
				if (mysql_fetch_array($result2, 0) > 0) 
				{
					mysql_query("UPDATE  `mess`.`meal_chart1` SET  `$username` =  'v' WHERE `meal_chart1`.`date` = '$day1/$month1/n'") ;
				}
				else
				{
					mysql_query("INSERT INTO `mess`.`meal_chart1` (`date`, `$username`) VALUES ('$day1/$month1/n', 'v')");
				}
			}
			
			if($food_night=='n')
			{
				echo ' & Night: Non Veg';
				if (mysql_fetch_array($result2, 0) > 0) 
				{
					mysql_query("UPDATE  `mess`.`meal_chart1` SET  `$username` =  'nv' WHERE `meal_chart1`.`date` = '$day1/$month1/n'") ;
				}
				else
				{
					mysql_query("INSERT INTO `mess`.`meal_chart1` (`date`, `$username`) VALUES ('$day1/$month1/n', 'nv')");
				}
			}
			echo  nl2br("\n");
			
		}
		else if($month1==$present_month1 && $day1==$present_day1 && $present_hour1<19) 
		{
			if (mysql_query("SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'mess' AND TABLE_NAME = 'meal_chart' AND COLUMN_NAME = ' '"))
			{
					mysql_query("ALTER TABLE  `meal_chart` ADD `$day1/$month1/d` VARCHAR( 255 ) NULL");
					mysql_query("ALTER TABLE  `meal_chart` ADD `$day1/$month1/n` VARCHAR( 255 ) NULL");
			}
			echo ' For ';
			echo $day1;
			echo '/';
			echo $month1;
			echo '/';
			echo $present_year1;
			echo ' your meal has been successfully updated as: ';
			if($present_hour1<8)
			{
			if(!$food_day)
			{
				echo 'Day: Off &';
				if (mysql_fetch_array($result1, 0) > 0) 
				{
					mysql_query("UPDATE  `mess`.`meal_chart1` SET  `$username` =  'off' WHERE `meal_chart1`.`date` = '$day1/$month1/d'") ;
				}
				else
				{
					mysql_query("INSERT INTO `mess`.`meal_chart1` (`date`, `$username`) VALUES ('$day1/$month1/d', 'off')");
				}
			}
			if($food_day=='v')
			{
				echo 'Day: Veg &';
				if (mysql_fetch_array($result1, 0) > 0) 
				{
					mysql_query("UPDATE  `mess`.`meal_chart1` SET  `$username` =  'v' WHERE `meal_chart1`.`date` = '$day1/$month1/d'") ;
				}
				else
				{
					mysql_query("INSERT INTO `mess`.`meal_chart1` (`date`, `$username`) VALUES ('$day1/$month1/d', 'v')");
				}
			}
			if($food_day=='n')
			{
				echo 'Day: Non Veg &';
				if (mysql_fetch_array($result1, 0) > 0) 
				{
					mysql_query("UPDATE  `mess`.`meal_chart1` SET  `$username` =  'nv' WHERE `meal_chart1`.`date` = '$day1/$month1/d'") ;
				}
				else
				{				
					mysql_query("INSERT INTO `mess`.`meal_chart1` (`date`, `$username`) VALUES ('$day1/$month1/d', 'nv')");
				}
			}
			}
			if(!$food_night)
			{	echo 'Night: Off';
				if (mysql_fetch_array($result2, 0) > 0) 
				{
					mysql_query("UPDATE  `mess`.`meal_chart1` SET  `$username` =  'off' WHERE `meal_chart1`.`date` = '$day1/$month1/n'") ;
				}
				else
				{
					mysql_query("INSERT INTO `mess`.`meal_chart1` (`date`, `$username`) VALUES ('$day1/$month1/n', 'off')");
				}
			}
			if($food_night=='v')
			{
				echo 'Night: Veg';
				if (mysql_fetch_array($result2, 0) > 0) 
				{
					mysql_query("UPDATE  `mess`.`meal_chart1` SET  `$username` =  'v' WHERE `meal_chart1`.`date` = '$day1/$month1/n'") ;
				}
				else
				{
					mysql_query("INSERT INTO `mess`.`meal_chart1` (`date`, `$username`) VALUES ('$day1/$month1/n', 'v')");
				}
			}
			
			if($food_night=='n')
			{
				echo 'Night: Non Veg';
				if (mysql_fetch_array($result2, 0) > 0) 
				{
					mysql_query("UPDATE  `mess`.`meal_chart1` SET  `$username` =  'nv' WHERE `meal_chart1`.`date` = '$day1/$month1/n'") ;
				}
				else
				{
					mysql_query("INSERT INTO `mess`.`meal_chart1` (`date`, `$username`) VALUES ('$day1/$month1/n', 'nv')");
				}
			}
			echo  nl2br("\n");
			
		}
		
	else { 
		echo 'xxxxxxxxxx---------Sorry!!!You cannot make any change on the selected date---------xxxxxxxxxxxxxxx ' ;
		echo  nl2br("\n");
		}
}
?><br/>
<a href=meals.php>Your Meals</a><br/>
<a href=pass_change.php>Change Password</a><br/>
<a href=logout.php>Logout</a>



