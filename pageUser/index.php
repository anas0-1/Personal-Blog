<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title>File Upload To Database</title>
	</head>
	<body>
		<h2>Please Choose a File and click Submit</h2>
		<form enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
  			Select Image File:
<input type="file" name="userfile"  size="4294967296">
<input type="hidden" name="MAX_FILE_SIZE" value="4294967296">
<br />
  			<input type="submit" value="Submit" />
  		</form>
	</body>
</html>
<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
/*
CREATE DATABASE store;
USE store;
CREATE TABLE testblob (
	id INT(5) NOT NULL AUTO_INCREMENT,
	name varchar(50) NOT NULL,
	type varchar(25) NOT NULL,
	size varchar(25) NOT NULL,
	image longblob NOT NULL,
	KEY id (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET GLOBAL max_allowed_packet=4294967296;
*/
function upload(){
	/***  get the image info. ***/
	$size = getimagesize($_FILES['userfile']['tmp_name']);
	/*** check if a file was uploaded ***/
	if(is_uploaded_file($_FILES['userfile']['tmp_name']) && ($size != false))
	{
		/*** assign our variables ***/
		$type = $size['mime'];
		$handle = fopen($_FILES['userfile']['tmp_name'], "rb");
		$size = $size[3];
		$name = $_FILES['userfile']['name'];
		$maxsize = 4294967296; // 4GB
		/***  check the file is less than the maximum file size ***/
		if($_FILES['userfile']['size'] < $maxsize )
		{
			$hostname = "localhost";
			$dbname = "store";
			$user = "root";
			$pass = "";
			try {
				/*** MySQL with PDO_MYSQL to connect with DB ***/
				$DBH = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);
				/*** set the error mode ***/
				$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				/*** SQL query ***/
				// STH means "Statement Handle"  
				$STH = $DBH->prepare("INSERT INTO testblob (name ,type, size, image) VALUES (? ,?, ?, ?)");
				/*** bind the params ***/
				$STH->bindParam(1, $name);
				$STH->bindParam(2, $type);
				$STH->bindParam(3, $size);
				$STH->bindParam(4, $handle, PDO::PARAM_LOB);
				/*** execute the query ***/
				$STH->execute();
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		else
		{
			/*** throw an exception is image is not of type ***/
			throw new Exception("File Size Error");
		}
	}
	else
	{
		// if the file is not less than the maximum allowed, print an error
		throw new Exception("Unsupported Image Format!");
	}
}

/*** check if a file was submitted ***/
if(!isset($_FILES['userfile'])) 
{
	echo "<p>Please select a file</p>";
}
else
{
	try{
		upload();
        echo "<p>Thank you for submitting</p>";
    }
    catch(Exception $e){
    	echo '<h4>'.$e->getMessage().'</h4>';
    }
}
?>