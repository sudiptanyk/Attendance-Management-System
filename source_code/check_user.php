<?php
include'navigation.php';

if(isset($_POST['Submit'])){
 $regdid=$_POST['regdid'];
 //$_SESSION['regd']=$regd;
 $conn = mysqli_connect("localhost", "root", "","rfid_data");
 $query = mysqli_query($conn, "SELECT * FROM empdetails WHERE regdid='$regdid'");
 $rows = mysqli_num_rows($query);
 if($rows == 1)
  echo'<script type="text/javascript">alert("User Exists.")</script>';
 else
 echo'<script type="text/javascript">alert("User Does not Exists.Please Add The User First.")</script>';
 mysqli_close($conn);
 }

?>
<!DOCTYPE html>
<html>
	<head>
		<title>SEARCHING USER</title>
		<script type="text/javascript">
			history.pushState(null,null,location.href);
			window.onpopstate=function(){
				history.go(1);
			};
			</script>
	</head>
	<body>
		<center>
			<h3>SEARCH USER</h3>
			<form action="" method="POST">
			<table>
				<tr>
					<td>Registration Number:</td>
					<td>
						<input type="text" name="regdid" required="" placeholder="Enter Regd No.">
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" name="Submit" value="Submit">
					</td>
				</tr>
			</table>
		</form>
		</center>
	</body>
</html>