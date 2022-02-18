<?php
///session_start();
$db = mysqli_connect("localhost","root","","rfid_data");
if(isset($_POST['submit'])){
	$email=$_POST['email'];
	$password=$_POST['password'];
	//$_SESSION['username'] = $Username;
	$query="SELECT * from emppersonal where username='$email' and password='$password'";
	$sql = mysqli_query($db,$query);
		$result=mysqli_num_rows($sql);

		if($result==1)
		{
			header("Location: users_data.php");
		}
		else
		{
			echo'<script type="text/javascript">alert("Invalid Credentials.Please Try Again")</script>';
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>AUTHENTICATE</title>
		<script type="text/javascript">
			history.pushState(null,null,location.href);
			window.onpopstate=function(){
				history.go(1);
			};
			</script>
	</head>
	<body>
		<center>
			<h3>Please Provide Your Credentials.</h3>
			<form action="" method="POST">
			<table>
				<tr>
					<td>EMAIL ID:</td>
					<td>
						<input type="text" name="email" required="" placeholder="Enter Username">
					</td>
				</tr>
				<tr>
					<td>PASSWORD:</td>
					<td>
					<input type="password" name="password" required="" placeholder="Enter Password">
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" name="submit" value="Login">
					</td>
				</tr>
		</center>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://localhost/rfid/send_email.php">Forgot Password?
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://localhost/rfid/send_email.php">Change Password?
		</a>
	</body>
</html>