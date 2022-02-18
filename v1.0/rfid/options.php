<?php
if (isset($_POST['Logout'])) { 
    session_destroy(); 
    unset($_SESSION['username']); 
    header("location:Logout.php"); 
}

?>



<!DOCTYPE html>
<html>
<head>
<style>
a:link, a:visited  {
  background-color:#40E0D0;
  color: white;
  padding: 80px 80px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

a:hover, a:active {
  background-color: #008080;
}

</style>
</head>
<body>
<form method="POST">
<td>
	<input type="submit" name="Logout" value="Logout">
</td>
</form>
<div class="topnav">
		<a href="http://localhost/rfid/options.php">Home</a>
  		<a href="http://localhost/rfid/add_user.php">Add Employee</a>
  		<a href="http://localhost/rfid/delete.php">Delete Employee</a>
  		<a href="http://localhost/rfid/check_user.php">Search Employee</a>
  		<a href="http://localhost/rfid/datewise_data.php">View Attendance</a>
  		<a href="http://localhost/rfid/export1.php">Export Data</a>
</div>
</body>
</html>
