<?php
	$host = 'localhost';
	$user = '4900';
	$password = '4900passWord';
	$connection = mysqli_connect($host, $user, $password);

	$reason = $_POST['reasontext'];
	$action = $_POST['actiontext'];
	$groupname = $_POST['groupnametext'];
	$textstories = $_POST['storytext'];
	$totalimage = $_POST['totalimage'];
	$imagenumber = intval($totalimage);
	$images = "";
	$video = "www.google.com";
	//$published = "";
	
	if($_POST['agreetoshare']=="false"){
		$agreetoshare = 0;
	}else{
		$agreetoshare = 1;
	}
	$posttime = date("Y-m-d H:i:s");

	
	date_default_timezone_set('UTC');
	$imagepath = "volunteer/".date("Y-m-d H:i:s").$groupname;


//store image on server
$target_dir = "pics";
if(!file_exists($target_dir))
{
mkdir($target_dir, 0777, true);
}


for($x=1; $x<=$imagenumber; $x++){
	
	$imageindex = "image".$x;
	$temp = explode(".", $_FILES["$imageindex"]["name"]);
	$newfilename = round(microtime(true)) . $x . '.' .end($temp);
	if($x==1){
		$images .= pathinfo($newfilename, PATHINFO_FILENAME);
	}else{
		$images .= "," . pathinfo($newfilename, PATHINFO_FILENAME);
	}
	$file_dir = $target_dir . "/" . $newfilename;

	if (move_uploaded_file($_FILES["$imageindex"]["tmp_name"], $file_dir)) 
	{
		echo json_encode([
		"Message" => "The file ". basename( $_FILES["$imageindex"]["name"]). " has been uploaded.",
		"Status" => "OK",
		]);
	} else {
		echo json_encode([
		"Message" => "Sorry, there was an error uploading your file.",
		"Status" => "Error",
		]);
	}
}
	 
//store text in db
if(!$connection){
		die('Connection Failed');
	}else{
		$dbconnect = @mysqli_select_db('VolunteerStories', $connection);
		if(!$dbconnect){
			die('Could not connect to Database');
		}else{
			$query = "INSERT INTO stories (reason, action, groupname, textstories, images, video, agreetoshare, posttime) VALUES ('$reason', '$action', '$groupname', '$textstories', '$images', '$video', '$agreetoshare', '$posttime');";
			mysqli_query($query, $connection) or die(mysqli_error());

			echo 'Successfully added.';
			//echo $query;
		}
	}

	echo "<br><br>what in database:<br>";


	
