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

		<?php
			$target_dir = "uploads/".$_FILES["fileToUpload"]["name"];
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) 
			{
			    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			    if($check !== false) 
			    {
			        //echo "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } 
			    else 
			    {
			        echo "File is not an image.";
			        $uploadOk = 0;
			    }
			}

		?>

		<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
		First Name: <input type="text" name="firstname">
		<span class="error">* <?php echo $firstnameErr;?></span>
  		<br><br>
		Last Name: <input type="text" name="lastname">
		<span class="error">* <?php echo $firstnameErr;?></span>
  		<br><br>
		Full Name: <input disabled="disabled" type = "text" name="fullname" value="<?php echo (isset($fullname))?$fullname:'';?>"><br><br>
		Upload Image: <input type="file" name="fileToUpload" id="fileToUpload">
		<br><br>
		<input type="submit" name="submit" value="Submit">
		</form>
		<h2>Welcome
		<?php
			if (preg_match("/^[a-zA-Z ]*$/",$fullname))
	    	{
	    		echo $fullname;
   			}
   		?>
   		<?php
   			
			if ($uploadOk == 0) 
			{
			    echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
			} 
			else 
			{
			    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
			    {
			        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			        echo "<img src=$target_file>";
			    } 
			    else
			    {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}
   		?>
   	</h2>
	</body>
</html>