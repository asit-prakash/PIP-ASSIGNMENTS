<html>
	<head>
		<title> assign 4</title>
		<style>
			.error {color: #FF0000;}
		</style>
	</head>
	<body>
		<?php
			$contact = $contactErr = "";
				if($_SERVER["REQUEST_METHOD"] == "POST")
				{
					if(isset($contact))
					{
						$contact=test_input($_POST["contact"]);
						if (preg_match("/^[+91]{3}[1-9]{1}[0-9]{9}$/",$contact))
					    {
					    	echo $contact;
				   		}
				   		else 
				   		{
				   			
				   			$contactErr = "Enter a valid contact number";
				   		}
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
			<input type="text" name="contact" id="contact" maxlength="14" pattern="[+91]{3}[1-9]{1}[0-9]{9}">
			<input type="submit" name="submit" id="submit">
			<span class="error">* <?php echo $contactErr;?></span>
		</form>
	</body>
</html>