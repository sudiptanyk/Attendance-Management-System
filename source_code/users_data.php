			<?php
			session_start();
			$username=$_SESSION['username'];
			if (!isset($_SESSION['username']))
			 { 
    		$_SESSION['msg'] = "You have to log in first"; 
    		header('location:start.php'); 
			}
			$connection=mysqli_connect("localhost","root","","rfid_data");

			$query="SELECT * from status where NAME='$username'";
			$query_run=mysqli_query($connection,$query);
			$result=mysqli_num_rows($query_run);
					if($result==0)
					{
						echo'<script type="text/javascript">alert("No Data Found.")</script>';
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
	<title>USER DATA</title>
</head>
<body>
	<script type="text/javascript">
      history.pushState(null,null,location.href);
      window.onpopstate=function(){
        history.go(1);
      };
</script> 
<center>
	<form method="POST" action="users_data_export.php"enctype="multipart/form-data">
		<h3>User Details</h3> 
                     <form method="post" action="users_data_export.php" align="center">  
                     <input type="submit" name="export" value="Export" class="btn btn-success" />  
                     </form>
                     <td>
						<input type="submit" name="Logout" value="Logout">
					</td>
                      
						<table class="table table-bordered">  
                          <tr>      
                               <th>ID</th>
                               <th>STATUS</th> 
                               <th>NAME</th>
                               <th>REGD</th>
                               <th>TIME</th> 
                               <th>DATE</th> 
                          </tr>  

                     <?php  
                     while($row = mysqli_fetch_array($query_run))  
                     {  
                     ?>  
                          <tr>     
                               <td><?php echo $row["ID"]; ?></td>
                               <td><?php echo $row["STATUS"]; ?></td>
                               <td><?php echo $row["NAME"]; ?></td> 
                               <td><?php echo $row["REGD"]; ?></td> 
                               <td><?php echo $row["TIME"]; ?></td>
                               <td><?php echo $row["DATE"]; ?></td>
                          </tr>  
                     <?php       
                     }  
                     ?>  
                     </table>
	</form>
</center>
</body>
</html>
