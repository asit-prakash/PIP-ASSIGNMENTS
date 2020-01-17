<html>
	<head>
		<title> assign 4</title>
		<style>
			.error {color: #FF0000;}
		</style>
	</head>
	<body>
		<?php
			$email=$emailErr="";
			if($_SERVER["REQUEST_METHOD"] == "POST")
				{
					$email=$_POST["email"];
					$email=test_input($email);
					$email = filter_var($email, FILTER_SANITIZE_EMAIL);
					if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) 
					{
				    	echo("$email is a valid email address");
					} 
					else 
					{
				    	$emailErr="Enter a valid email address";
					}
						
				}
			
				function test_input($data) 
				{
				  $data = trim($data);
				  $data = stripslashes($data);
				  $data = htmlspecialchars($data);
				  return $data;
				}
		?>
		<form method='POST' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<input type="text" name="email" id="email" maxlength="320">
			<input type="submit" name="submit" id="submit">
			<span class="error">* <?php echo $emailErr;?></span>
		</form>
	</body>
</html>