<?php
session_start();
$db = mysqli_connect("localhost","root","","rfid_data");
if(isset($_POST['submit'])){
	$captcha=$_POST['captcha'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$_SESSION['username'] = $username;
	$session_captcha=$_SESSION['CODE'];
	$query="SELECT * from admin where username='$username' and password='$password'";
	$sql = mysqli_query($db,$query);
		$result=mysqli_num_rows($sql);
		if($session_captcha==$captcha){
		if($result==1)
		{
			header("Location: options.php");
		}
		else
		{
			echo'<script type="text/javascript">alert("Invalid Credentials.Please Try Again")</script>';
		}
	}
	else{
		echo'<script type="text/javascript">alert("Invalid Captcha.Please Try Again")</script>';
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
					<td>Username:</td>
					<td>
						<input type="text" name="username" required="" placeholder="Enter Username">
					</td>
				</tr>
				<tr>
					<td>Password:</td>
					<td>
					<input type="password" name="password" required="" placeholder="Enter Password">
					</td>
				</tr>
				<tr>
					<td>Captcha:</td>
					<td>
					<input type="text" name="captcha" required="" placeholder="Enter Captcha Code">
					</td>
					<img src="captcha.php">
				</tr>
				<tr>
					<td>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://localhost/rfid/send_email_admin.php">Forgot Password?
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" name="submit" value="Login">
					</td>

				</tr>
				
		</center>
	</body>
</html>