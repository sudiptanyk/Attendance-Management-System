<?php
include'navigation.php';
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$connection=mysqli_connect("localhost","root","");
$db=mysqli_select_db($connection,"rfid_data");
if(isset($_REQUEST["submit"]))
	{
	$chk=$_REQUEST["chk"];
	if(empty($chk)){
		echo'<script type="text/javascript">alert("Please Select Atleast One.")</script>';
	}
	else{
	$a=implode(",",$chk);
	$query2="DELETE from empdetails where sl in($a)";
	$result2=mysqli_query($connection,$query2);
	echo'<script type="text/javascript">alert("User Deleted Successfully.")</script>';
	}

}
$query="SELECT * from empdetails";
$result = mysqli_query($connection,$query);
$rowcount=mysqli_num_rows($result);
?>
<form method="POST">
<table border="3" align="center">
	<tr>
		<td>Photo</td>
		<td>Name</td>
		<td>Email</td>
		<td>Regd</td>
		<td>Tag Id</td>
		<td>Department</td>
		<td><input type="submit" name="submit" value="Submit"></td>
	</tr>

<?php
for($i=1;$i<=$rowcount;$i++)
{
	$row=mysqli_fetch_array($result);
?>
<center>
<h3>Select the ones you want to delete.</h3>
<tr>
	<td> <?php echo '<img src="data:image;base64,'.base64_encode($row['photo']).'"alt="Image" style="width:100px;height:100px;">'; ?> </td>
	<td><?php echo $row['name']?></td>
	<td><?php echo $row['email']?></td>
	<td><?php echo $row['regdid']?></td>
	<td><?php echo $row['tagid']?></td>
	<td><?php echo $row['dept']?></td>
	<td><input type="checkbox" value="<?php echo $row["SL"]?>" name="chk[]"></td>
</tr>
</center>
<?php
}
?>

</table>
</form>
<script type="text/javascript">
			history.pushState(null,null,location.href);
			window.onpopstate=function(){
				history.go(1);
			};
</script>