
<?php
require "include/config.php";



$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $query = isset($_GET['query']) ? mysqli_real_escape_string ($conn, $_GET['query']) :  "";

if(isset($_POST['submit'])) {

	
	echo ($_POST['x1']);
	echo ($_POST['y1']);
	echo ($_POST['w']);
	echo ($_POST['h']);
}


?>


<!DOCTYPE html>
<html>
<head>
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" type="text/css" href="css/imgareaselect-default.css" />
		<script type="text/javascript" src="scripts/jquery.min.js"></script>
		<script type="text/javascript" src="scripts/jquery.imgareaselect.pack.js"></script>

	<script type="text/javascript">

	
$(document).ready(function () {
    $('img#photo').imgAreaSelect({
        handles: true,
	onSelectEnd: function (img, selection) {
                $('input[name="x1"]').val(selection.x1);
                $('input[name="y1"]').val(selection.y1);
                $('input[name="w"]').val(selection.width);
                $('input[name="h"]').val(selection.height);          
			
		
	}	
    });
});




</script>
	  
	  
</head>
<title>Pollution Detector Gallery</title>
<body>




<div id="picture" style="margin: 0 0.3em; width: 600px; height: 500px;">
	<img id="photo" src="photos/image.jpg" alt="Image" style="margin: 0 0.3em; width: 600px; height: 500px;">
</div>

<div id="options">
	<select multiple>
  <option value="Plastic Bottle">Plastic Bottle</option>
  <option value="Oil">Oil</option>
  <option value="Other">Other</option>
</select>



<form action="display.php" method="post" enctype="multipart/form-data">
   
    <input type="hidden" name="x1" value="" />
    <input type="hidden" name="y1" value="" />
    <input type="hidden" name="w" value="" />
    <input type="hidden" name="h" value="" /><br><br>
    <input type="submit" name="submit" value="Select this location" />
	
	
</form>

</div>

</body>
</html>