<?php
	error_reporting(E_ERROR | E_PARSE);
	date_default_timezone_set("Asia/Calcutta");
	$currentTime =date("H:i:s");
	$date=date("d-m-Y");
	//Entry and exit times
	$entryTime="23:10:00";
	$entrylimit="23:55:00";
	$entryupto="00:10:00";
	$exitTime="00:30:00";
	$exitlimit="00:00:00";

	$tagid = $_GET['tagid'];
	//echo $tagid;
	$absentees=$_GET['absentees'];
	//echo $absentees;

	$db=mysqli_connect("localhost","root","","rfid_data");

	if($absentees=="Absent"){
		
		$query="INSERT into attendance(name,tagid,regdid,status,time,date) (select empdetails.name,empdetails.tagid,empdetails.regdid,'Absent','NULL','$date' from empdetails)";
		$result=mysqli_query($db,$query);
		//echo"Executed";
		}

		if($tagid!="NULL"){
			$query = "SELECT * from empdetails where tagid = '$tagid'";  
		    $result = mysqli_query($db, $query);
		    $rows = mysqli_num_rows($result);

		    //if($rows == 1){
		    	$user = mysqli_fetch_array($result);
		    	if (strtotime($entryTime)<=strtotime($currentTime) && strtotime($currentTime)<=strtotime($entrylimit))
		    	{
				  
				  $status="Present";
				  $time="NULL";
				  //$data1="SELECT * FROM attendance WHERE tagid='$tagid'and status='$status' AND date='$date'";
				  //$queryy = mysqli_query($db,$data1);
		    	  //$rowss = mysqli_num_rows($queryy);
		    	  //echo $rowss;

		    	  		//if($rowss==0)
		    	  		//{
		  			$sql_store = "UPDATE attendance SET status='$status',time='$currentTime',date='$date' WHERE (tagid='$tagid'and time='$time') and date='$date'";
		  			mysqli_query($db, $sql_store) or die(mysqli_error($db));
		  			//$query2="SELECT TIME from status where ID='$id'";
					//$result2=mysqli_query($db,$query2);
					//$data=mysqli_fetch_array($result2);
					echo "Hii $user[name],You Are Marked Present.";
					echo"Your Entry Time is:";
					echo $currentTime;
					echo ".";
		   		}
		  		//else
					//echo "$user[name] your attendance is already taken.";
		//}

		else if(strtotime($entrylimit)<=strtotime($currentTime)&& strtotime($currentTime)<=strtotime($entryupto))
		{
		   		$status="Late";
		   		$time="NULL";
		    	$queryy = mysqli_query($db, "SELECT * FROM attendance WHERE tagid='$tagid',status='$status' AND date='$date'");
    			$rowss = mysqli_num_rows($queryy);
		   			//if($rowss==0)
		   			//{ 
		  				$sql_store = "UPDATE attendance SET status='$status',time='$currentTime',date='$date' WHERE (tagid='$tagid'and time='$time') and date='$date'";
		  				mysqli_query($db, $sql_store) or die(mysqli_error($db));
		  				//$query2="SELECT TIME from status where ID='$id'";
						//$result2=mysqli_query($db,$query2);
						//$data=mysqli_fetch_array($result2);
						echo "Hii $user[name],You are late today.";
						echo"Your Entry Time is:";
						echo $currentTime;	
					//}
					//else
					//	echo "$user[name] your attendance is already taken.";
		}

		/*else if(strtotime($entryupto)<strtotime($currentTime))
			{	
				echo "Sudi";
				$status="Absent";
				$queryy=mysqli_query($db," INSERT into attendance values (NULL,select empdetails.name,empdetails.tagid,empdetails.regdid,'Absen','NULL','$date'  from empdetails,attendance where (empdetails.tagid<>attendance.tagid and date='$date'))");
				echo"Done";


			}*/

		else if(strtotime($exitTime)<=strtotime($currentTime)&& strtotime($currentTime)<=strtotime($exitlimit))
			{
				 $status="Out time";
				 $time="NULL";
				 $queryy = mysqli_query($db, "SELECT * FROM attendance WHERE tagid='$tagid',status='$status' AND date='$date'");
	    		 $rowss = mysqli_num_rows($queryy);
	    		 //echo $rowss;
				 	//if($rowss==0)
				 	//{
				 		"UPDATE attendance SET status='$status',time='$currentTime',date='$date' WHERE (tagid='$tagid'and time='$time') and date='$date'";
			  			mysqli_query($db, $sql_store) or die(mysqli_error($db));
			  			//$query2="SELECT TIME from status where ID='$id'";
						//$result2=mysqli_query($db,$query2);
						//$data=mysqli_fetch_array($result2);
						echo "Bye $user[name],Hope you had a great day!!!";
						echo"Your Exit Time is:";
						echo $currentTime;
					//}
					//else
					//	echo "$user[name] your attendance is already taken.";
			}
		

		else
		echo "Hii $user[name],It's not the time to enter or exit.";
		
    }
    else
    	echo "You Don't Have Authentication.";

 ?>


