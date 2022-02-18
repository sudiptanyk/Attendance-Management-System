			<?php
			session_start();
			if (!isset($_SESSION['username']))
			 { 
    		$_SESSION['msg'] = "You have to log in first"; 
    		header('location:start.php'); 
			}
			$connection=mysqli_connect("localhost","root","");
			$db=mysqli_select_db($connection,'rfid_data');

			$query="SELECT * from attendance";
			$query_run=mysqli_query($connection,$query);?>

<!DOCTYPE html>
<html>
<head>
	<title>Display Image</title>
</head>
<body>
	<script type="text/javascript">
      history.pushState(null,null,location.href);
      window.onpopstate=function(){
        history.go(1);
      };
</script> 
<center>
	<form method="POST" action="export_current.php"enctype="multipart/form-data">
		<h3>User Details</h3>
		<a href="http://localhost/rfid/options.php">Home Page</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="http://localhost/rfid/add_user.php">Add Users</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                     <input type="submit" name="export_current" value="Export" class="btn btn-success" />  
                </form>
		<table width="50%" border="1" cellpadding="5" cellspacing="5">
			<thead>
				<tr>
					<th>Photo</th>
					<th>Name</th>
					<th>Registration Number</th>
					<th>Tag Id</th>
				</tr>
			</thead>
			<?php

			while($row=mysqli_fetch_array($query_run))
			{
				?>
				<tr>
					<td> <?php echo '<img src="data:image;base64,'.base64_encode($row['IMAGE']).'"alt="Image" style="width:100px;height:100px;">'; ?> </td>

					<td><?php  echo $row['NAME']?></td>
					<td> <?php  echo $row['REGD']?></td>
					<td> <?php  echo $row['ID']?></td>

				</tr>

				<?php
			}
			?>
		</table>
	</form>
</center>
</body>
</html>
