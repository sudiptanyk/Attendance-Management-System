<!DOCTYPE html>
<html>
<head>
	<title>DATA</title>
</head>
<body>
	<center>
	<form method="post">
		<input type="Date" name="StartDate">
		<input type="Date" name="EndDate">
		<p>
			<input type="submit" name="Search" value="Search">
		</p>
	</form>
<?php
$db = mysqli_connect("localhost","root","","rfid_data");

if(isset($_POST['Search'])){

$StartDate=$_POST['StartDate'];
$EndDate=$_POST['EndDate'];
$query="SELECT EmpName from addemployee where JoinDate between '$StartDate' and '$EndDate' order by  JoinDate";
$result=mysqli_query($db,$query);
$count=mysqli_num_rows($result);
		if($count > 0)
		{
			while($row=mysqli_fetch_array($result)){
				$output=$row['EmpName'];
				echo $output;
				echo "<br>";
				
			}
		}
		else
			echo'<script type="text/javascript">alert("No Data Found.")</script>';
}

?>
</center>
</body>
</html>