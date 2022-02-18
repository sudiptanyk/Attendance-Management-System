<?php
if(isset($_POST['Login'])){
		header("Location: start.php");
	}
?>
<!doctype html>
<html>
<head>
	<center>
<meta charset="UTF-8">
<script type="text/javascript">
			history.pushState(null,null,location.href);
			window.onpopstate=function(){
				history.go(1);
			};
			</script>
</head>
<body>
	<form action="" method="POST">
<h3>YOU HAVE SUCCESSFULLY LOGGED  OUT</h3>
<td>
		<input type="submit" name="Login" value="Login">
</td>
</center>
</body>
</html>

