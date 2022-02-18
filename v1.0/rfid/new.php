<?php
date_default_timezone_set("Asia/Calcutta");
$date=date("d-m-Y");
$absentees=$_GET['absentees'];
//$tagid=$_GET['tagid'];

if($absentees=="Absent"){
$db=mysqli_connect("localhost","root","","rfid_data");
$query="INSERT into attendance(name,tagid,regdid,status,time,date) (select empdetails.name,empdetails.tagid,empdetails.regdid,'Absent','NULL','$date' from empdetails)";
$result=mysqli_query($db,$query);
echo"Executed";
}
?>
