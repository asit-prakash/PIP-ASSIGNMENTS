<html>
	<head>
		<title>PHP 1</title>
		<style>
			.error {color: #FF0000;}
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		   <script>
		            $(document).ready(function(){
		                  $('#lastname').click(function(){
		                     $('#fullname').removeAttr("disabled");
		                  });
		               });
		   </script>
	</head>
	<body>
		<?php
		$firstnameErr = $lastnameErr = "";
		$firstname = $lastname = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$firstname = test_input($_POST["firstname"]);
	    	// check if name only contains letters and whitespace
	    	if (!preg_match("/^[a-zA-Z ]*$/",$firstname))
	    	{
	    		$firstnameErr = "Only letters and white space allowed";
   			}
   			$lastname = test_input($_POST["lastname"]);
	    	// check if name only contains letters and whitespace
	    	if (!preg_match("/^[a-zA-Z ]*$/",$lastname))
	    	{
	    		$lastnameErr = "Only letters and white space allowed";
   			}
   			$fullname = $firstname.' '.$lastname;
		}
		function test_input($data) 
		{
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}
		?>

		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
		First Name: <input type="text" name="firstname">
		<span class="error">* <?php echo $firstnameErr;?></span>
  		<br><br>
		Last Name: <input type="text" name="lastname">
		<span class="error">* <?php echo $firstnameErr;?></span>
  		<br><br>
		Full Name: <input disabled="disabled" type = "text" name="fullname" value="<?php echo (isset($fullname))?$fullname:'';?>"><br>
		<input type="submit" name="submit" value="Submit">
		</form>
		<h2>Welcome
		<?php
			if (preg_match("/^[a-zA-Z ]*$/",$fullname))
	    	{
	    		echo $fullname;
   			}
   		?>
   	</h2>
	</body>
</html>