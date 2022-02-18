<?php
session_start(); 
if (!isset($_SESSION['username'])) { 
    $_SESSION['msg'] = "You have to log in first"; 
    header('location:start.php'); 
} 
	if (isset($_POST['Logout'])) { 
    session_destroy(); 
    unset($_SESSION['username']); 
    header("location:Logout.php"); 
} 
	
?>

<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript">
			history.pushState(null,null,location.href);
			window.onpopstate=function(){
				history.go(1);
			};
	</script>
</head>
<body>
	<center>
		<form action="" method="POST">
			<p> 
                Welcome  
                <strong> 
                    <?php echo $_SESSION['username']; ?> 
                </strong> 
            </p>
	<div class="topnav">
		<a href="http://localhost/rfid/options.php">Home</a>
  		<a href="http://localhost/rfid/add_user.php">Add Employee</a>
  		<a href="http://localhost/rfid/delete.php">Delete Employee</a>
  		<a href="http://localhost/rfid/check_user.php">Search Employee</a>
  		<a href="http://localhost/rfid/datewise_data.php">View Attendance</a>
  		<a href="http://localhost/rfid/export1.php">Export Data</a>
  		<td>
			<input type="submit" name="Logout" value="Logout">
		</td>
	</div>
		</form>
	</center>
</body>
</html>
