
<?php
require "include/config.php";
session_start();


$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


	if (isset($_POST['submit'])) {
	

	$statusMsg = '';
	
	

// File upload path
$targetDir = "photos/";
$fileName = basename($_FILES["selectfile"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$max_post_size = ini_get('upload_max_filesize');
$content_length = $_SERVER['CONTENT_LENGTH'] / 1024 / 1024;

if(isset($_POST["submit"]) && !empty($_FILES["selectfile"]["name"])){
	
	// check size 
	 
       if ($content_length < $max_post_size ) {
		
	
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','JPG');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["selectfile"]["tmp_name"], $targetFilePath)){
			
			
            // Insert image file name into database
            $insert = $conn->query("INSERT INTO `Image` (`ID`, `Image_path`) VALUES (NULL, '".$fileName."')");
			
            if($insert){
				
				$result = $conn->query("SELECT `ID` FROM `Image` WHERE `Image_path`='".$fileName."'");
				
					while ($row = $result->fetch_assoc()) {
					$_SESSION['EditId']= $row['ID'];
					
					header("location: display.php");
					
					}
				
				
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
				
            }else{
                $statusMsg1 = "File upload failed, please try again.";
            } 
					
        }else{
            $statusMsg1 = "Sorry, there was an error uploading your file.";
        }
		
		
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed to upload.';
    }
	}else {
            $statusMsg = 'Sorry. Your file is too large. Only 5MB is allowed.';
        } 
	
	
}else{
    $statusMsg = 'Please select a file to upload.';
}


	}
 
?>





<!DOCTYPE html>
<html>
<head>
	  <link rel="stylesheet" href="css/styles.css">

	 
</head>
<title>The Ocean CleanX Portal!</title>



<body>

<div class="bg-image"></div>



<h1>Welcome to The Ocean CleanX Portal!</h1>

<h3>Upload & Tag the pollution, Get Started!</h3>
<br>
<br>
<br>
<div id='upload'>

<div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">

<form id="Upload_image" method="POST" action="index.php" enctype="multipart/form-data">
		<input type="file" id="selectfile" name="selectfile" value="">
		<input id="UploadBtn" type="submit" value="Upload" name="submit" onclick="validate()" >

</form>

   
</div>

<script>

   function validate(){
	var btn = document.getElementById('UploadBtn');
	 var img = document.getElementById('selectfile');
	  
	 
	 if  (img.value == 0) {
		 
		alert("Please select a file to upload.");
		

	}
   
   }
   

</script>

	 
</div>

<p id="errorMsg" style="color: #ff0101;"><?php if(isset($_POST["submit"])){
	echo $statusMsg;
	}
	?>
	</p>
</body>
</html>