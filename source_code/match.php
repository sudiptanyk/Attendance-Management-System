<?php
if (!isset($_SESSION['username'])) { 
    $_SESSION['msg'] = "You have to log in first"; 
    header('location:start.php'); 
}
	error_reporting(E_ERROR | E_PARSE);
	date_default_timezone_set("Asia/Calcutta");
	$currentTime =date("H:i:s");
	$date=date("d-n-Y");
	$entryTime = "11:30:00";
	$exitTime  = "20:00:00";
	$entrylimit="11:45:00";
	$exitlimit="23:00:00";
	$entryupto="12:00:00";

	$id = $_GET['id'];
	$db = mysqli_connect("localhost","root","","rfid_data");
	$query = "SELECT NAME from attendance where ID = '$id'";  
    $result = mysqli_query($db, $query);
    $rows = mysqli_num_rows($result);
    if($rows > 0){
    	$user = mysqli_fetch_array($result);
    	if (strtotime($entryTime)<=strtotime($currentTime)&& strtotime($currentTime)<=strtotime($entrylimit)){
		  echo "Hii $user[NAME],You Are Marked Present.";
		  $status="In time";
		  $data1="SELECT * FROM status WHERE ID='$id',status='In time' AND DATE='$date'";
		   $queryy = mysqli_query($db,$data1);
    		$rowss = mysqli_num_rows($queryy);
    	  if($rowss==0){
		  $sql_store = "INSERT into status VALUES (NULL,'$id','$status','$user[NAME]','$regd','$currentTime', '$date')";
		  mysqli_query($db, $sql_store) or die(mysqli_error($db));
		  $query2="SELECT TIME from status where ID='$id'";
			$result2=mysqli_query($db,$query2);
			$data=mysqli_fetch_array($result2);
			echo"Your Entry Time is:";
			echo $currentTime;}
			else
			echo "$user[NAME] your attendance is already taken";
			}
 

		else if(strtotime($exitTime)<=strtotime($currentTime)&& strtotime($currentTime)<=strtotime($exitlimit)){
			echo "Bye $user[NAME],Hope you had a great day!!!";
			$status="Out time";
			 $queryy = mysqli_query($db, "SELECT * FROM status WHERE ID='$id',status='$status' AND DATE='$date'");
    		$rowss = mysqli_num_rows($queryy);
    		echo $rowss;
			if($rowss==0){
		  $sql_store = "INSERT into status VALUES (NULL,'$id','$status','$user[NAME]','$regd','$currentTime', '$date')";
		  mysqli_query($db, $sql_store) or die(mysqli_error($db));
		  $query2="SELECT TIME from status where ID='$id'";
			$result2=mysqli_query($db,$query2);
			$data=mysqli_fetch_array($result2);
			echo"Your Exit Time is:";
			echo $currentTime;}
			else
			echo "$user[NAME] your attendance is already taken";
			}


		else if(strtotime($entrylimit)<=strtotime($currentTime)&& strtotime($currentTime)<=strtotime($entryupto)){
			echo "Hii $user[NAME],You are late today";
		   $status="In time";
		    $queryy = mysqli_query($db, "SELECT * FROM status WHERE ID='$id',Status='$status' AND DATE='$date'");
    		$rowss = mysqli_num_rows($queryy);
		   if($rowss==0){ 
		  $sql_store = "INSERT into status VALUES (NULL,'$id','$status','$user[NAME]','$regd','$currentTime', '$date')";
		  mysqli_query($db, $sql_store) or die(mysqli_error($db));
		  $query2="SELECT TIME from status where ID='$id'";
			$result2=mysqli_query($db,$query2);
			$data=mysqli_fetch_array($result2);
			echo"Your Entry Time is:";
			echo $currentTime;	}
			else
			echo "$user[NAME] your attendance is already taken";
			}
		

		else
		echo "Hii $user[NAME],It's not the time to enter or exit";
		
    }
    else
    	echo "You Don't Have Authentication";
 ?>
