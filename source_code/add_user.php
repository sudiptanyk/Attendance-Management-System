<?php
include'navigation.php';
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
$db = mysqli_connect("localhost","root","","rfid_data");
	if(isset($_POST['Submit'])){
		$file=addslashes(file_get_contents($_FILES["photo"]["tmp_name"]));
		$name=$_POST['name'];
		$name_substr=substr($name,0,4);
		$email=$_POST['email'];
		$regdid=$_POST['regdid'];
		$regd_substr=substr($regdid,0,4);
		$tagid=$_POST['tagid'];
		$dept=$_POST['dept'];
		$password=$name_substr.$regd_substr;
		$check_duplicate="SELECT * FROM empdetails WHERE tagid='$tagid'";
		$sql = mysqli_query($db,$check_duplicate);
		$result=mysqli_num_rows($sql);
		if($result > 0){
			echo'<script type="text/javascript">alert("The User Already Exists.")</script>';
		}
		else{
		require 'vendor/autoload.php';

	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->SMTPDebug = 0;                      // Enable verbose debug output
	    $mail->isSMTP();                                            // Send using SMTP
	    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = 'sudiptanayak7540@gmail.com';                     // SMTP username
	    $mail->Password   = '7540@Sudi#';                               // SMTP password
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

	    //Recipients
	    $mail->setFrom('sudiptanayak7540@gmail.com', 'RFID Project');
	    $mail->addAddress("$email", "$email");     // Add a recipient
	    //$mail->addAddress('ellen@example.com');               // Name is optional
	    //$mail->addReplyTo('info@example.com', 'Information');
	    //$mail->addCC('cc@example.com');
	    //$mail->addBCC('bcc@example.com');

	    // Attachments
	    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

	    // Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = "Password Reset";
	    $mail->Body    = 'Hii ' .$name .' ,you are now registered in the attendance portal,your username is your email id and password is a combination of first four letters of your name and registration number.
	    	Example:
	    	Name:Rohit.
	    	Registration No:12345678.
	    	Then Password would be "Rohi1234"(without quotes).
	    	Please donot share it with anyone and change it at the earliest.
	    	You can now visit the portal to view your attendance.';
	    $mail->AltBody = 'Hii ' .$name .' ,you have been registered in the attendance portal,your username is your email id and password is a combination of first four letters of your name and registration number.
	    	Example:
	    	Name:Rohit.
	    	Registration No:12345678.
	    	Then Password would be "Rohi1234"(without quotes).
	    	Please donot share it with anyone and change it at the earliest.
	    	You can now visit the portal to view your attendance.';

	    $mail->send();
	    $sql_store1 = "INSERT into empdetails VALUES (NULL,'$name','$email','$regdid','$tagid','$dept','$file')";
		$sql_store2="INSERT into emppersonal VALUES ('$email','$password')";
		$sql = mysqli_query($db,$sql_store1) or die("Could not connect to database");
		$sql = mysqli_query($db,$sql_store2) or die("Could not connect to database");
	    echo'<script type="text/javascript">alert("User Added Successfully.")</script>';
		} 
	catch (Exception $e)
	{ 
	    echo'<script type="text/javascript">alert("User could not be added.Please Try again later.")</script>';
	}
 }

		
	        
	} 	

?>


<!DOCTYPE html>
<html>
	<head>
		<title>ADD USER</title>
		<script type="text/javascript">
			history.pushState(null,null,location.href);
			window.onpopstate=function(){
				history.go(1);
			};
</script>
	</head>
	<body>
		<center>
			<h3>ADD USER</h3>
			<form action="" method="POST" enctype="multipart/form-data">
			<table>
				<tr>
					<td>Name:</td>
					<td>
						<input type="text" name="name" required="" placeholder="Enter your Name">
					</td>
				</tr>
				<tr>
					<td>Email Id:</td>
					<td>
						<input type="text" name="email" required="" placeholder="Enter Email Id">
					</td>
				</tr>
				<tr>
					<td>Registration Number:</td>
					<td>
						<input type="text" name="regdid" required="" placeholder="Enter Regd No.">
					</td>
				</tr>
				<tr>
					<td>Tag ID:</td>
					<td>
					<input type="text" name="tagid" required="" placeholder="Enter Tag ID">
					</td>
				</tr>
				<tr>
					<td>Department:</td>
					<td>
					<select name="dept" required="">
						<option value="">--Select--</option>
						<option value="Account And Finance">Account And Finance</option>
						<option value="Human Resources">Human Resources</option>
						<option value="Production And Development">Production And Development</option>
						<option value="Research And development">Research And development</option>
						<option value="Sales And Marketing">Sales And Marketing</option>
						<option value="Security And Transport">Security And Transport</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>Upload Photo:</td>
					<td>
					<input type="file" name="photo" id="photo" required="" /><br>
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
		<script type="text/javascript">
			history.pushState(null,null,location.href);
			window.onpopstate=function(){
				history.go(1);
			};
			</script>
	</body>
</html>