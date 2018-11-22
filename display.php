
<?php
require "include/config.php";
session_start();

if ($_SESSION['EditId'] == null){
		header("location: index.php");
	}

else {


$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if(isset($_POST['submit'])) {
	
	$errorMsg = "";

	$Left =($_POST['x1']);
	$Top = ($_POST['y1']);
	$Width= ($_POST['w']);
	$Height =($_POST['h']);
	$Pollutant_ID =($_POST['Pollutant_name']);
	
	
	
	if ($Left ==null) {
		$errorMsg = "*Please select polluted area from the image.";
	}
	else if($Pollutant_ID == 0) {
		$errorMsg = "*Please select the type of pollution.";
	}
	else {
	$query2 = "UPDATE `image` SET `Left` = '".$Left."', `Top` = '".$Top."', `Height` = '".$Height."', `Width` = '".$Width."', 
				`Pollutant_ID` = '".$Pollutant_ID."' WHERE `image`.`ID` = '".$_SESSION['EditId']."' "; 
	mysqli_query($conn, $query2);
	
	
	session_destroy();	
	
	if (mysqli_query($conn, $query2)){
		header("location: submit.php");
	}
	
}
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
<link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">


<title>Pollution Detector Gallery</title>
<body>



<?php
	
	$query= "SELECT image.Image_path FROM `Image` WHERE image.ID = '".$_SESSION['EditId']."'";
		$stmt  = mysqli_prepare($conn,$query);

		mysqli_stmt_execute($stmt);
	
		$result = mysqli_stmt_get_result($stmt);
	
		$row = mysqli_fetch_assoc($result)



?>
<div id="note">
<p>Almost done... Spot the pollutant and categorize it!</p>
</div>

<p id="errorMsg" style="color: #ff0101; font-weight: bold;"><?php if(isset($_POST["submit"])){
	echo $errorMsg;
	}
	?>
	</p>



<div id="container">


<div id="picture" style="margin: 0; width: 600px; height: 500px;">
	<img id="photo" src="<?php echo 'photos/'.($row['Image_path']);?>" alt="Image" style="margin: 0; width: 600px; height: 500px;">
</div>

<form action="display.php" method="post" enctype="multipart/form-data">
<div id="options">
	<select id="Pollutant_name" name="Pollutant_name" multiple>
  <option value="1">Plastic Bottle</option>
  <option value="2">Oil</option>
  <option value="3">Cigarette Butt</option>
  <option value="4">Mix Debris</option>
  <option value="5">Plastic Container</option>
  <option value="6">Plastic Straws</option>
  <option value="7">Cotton Buds</option>
  <option value="8">Other</option>
<option selected hidden value ="0"></option>
</select>

   
    <input type="hidden" name="x1" value="" />
    <input type="hidden" name="y1" value="" />
    <input type="hidden" name="w" value="" />
    <input type="hidden" name="h" value="" />
    <input id="Submit_btn" type="submit" name="submit" value="Select this location" onclick="myFunction()"/>
	
	
</form>

</div>
</div>
</body>
</html>


<?PHP 
}
?>