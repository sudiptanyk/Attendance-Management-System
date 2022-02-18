<?php 
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
$connection=new mysqli("localhost","root","","rfid_data");
 if($_POST)
 {
 	$email=$_POST['email'];
 	$dbquery="SELECT * FROM admin where email='$email'";
 	 $result=mysqli_query($connection,$dbquery);
 	 $count=mysqli_num_rows($result);
 	 $row=mysqli_fetch_array($result);
 	 if($count==1)
 	 {
	 	 	
	// Import PHPMailer classes into the global namespace
	// These must be at the top of your script, not inside a function
	

	// Load Composer's autoloader
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
	    $mail->Body    = 'Hii ' .$row['username'] .' your password is '.$row['password'].' .Please donot share it with anyone.';
	    $mail->AltBody = 'Hii ' .$email .' your password is '.$row['password'].' .Please donot share it with anyone.';

	    $mail->send();
	    echo'<script type="text/javascript">alert("Password Has been sent to your respective email Id.")</script>';
		} 
	catch (Exception $e)
	{ 
	    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}

	}
 	 else
 	 	echo'<script type="text/javascript">alert("Invalid EmailId.")</script>';
 }
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<center>
	<h3>
		Please Enter Your Email Id
	</h3>
 <form method="post">
 	Email:<input type="email" name="email"> <br>
 	<input type="submit" value="Submit">
 </form>
 </center>
</body>
</html>