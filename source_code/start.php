<?php
session_start();
if(isset($_POST['Admin'])){
header("Location: authentication.php");
}

if(isset($_POST['Users'])){
header("Location: users_login.php");
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
</head>
<body>
	<form action="" method="POST">
	<center>
		<h1>Welcome To The Attendance Portal.</h1>
		<h4>
			The aim of this project is to maintain the record of the employees attendance by using RFID tags. Each employee is issued with his/ her authorized tag, which can be used for swiping in front of the RFID reader to record their attendance.

			In most of the workplaces,attendance is recorded manually – such a process consumes lots of time. In this proposed system, attendance system is implemented by using advanced wireless technology “RFID”. Only the authorized persons are provided with the RFID tags. This tag consists of an inbuilt integrated circuit for storing and processing information.
		</h4>
<tr>
	Admin
	<td>					
	<button name="Admin">Login</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</td>
</tr>

<tr>
	Users
	<td>						
	<button name="Users">Login</button>
	</td>
</tr>
</center>
<ul>
	Features:
	<li>Positive Work Environment</li>
	<h5>Timely attendance updates and error free payroll leads to happier workspace</h5>
	<li>Intelligent Reports</li>
	<h5>Export and import information to avoid errors or disputes</h5>
	<li>Efficient and Reliable</li>
	<h5>As the data is stored in the database,chances of dataloss is negligible</h5>
	<li>Environment Friendly</li>
	<h5>Say goodbye to the old and tiresome process of storing records in record books</h5>

</ul>
</body>
<footer>
	<p>Project By: Sudipta Nayak</p>
	<p>Email:<a href="mailto:sudiptanayak55@gmail.com">sudiptanayak55@gmail.com</a></p>
</footer>
</html>



