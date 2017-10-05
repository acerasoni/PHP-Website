<?php
include 'db.php'; // include our database connection
$artName = $_GET['artName'];
$sql = "INSERT INTO artist (artName) VALUES ('$artName')";
if(!$artName){
	header("Location: /?page=artists&error=2");
}
else{
	if(mysqli_query($conn,$sql)){
		header("Location: /?page=artists&error=0"); /* Redirect browser */
		exit();
	}	else {
		header("Location: /?page=artists&error=1");}
	mysqli_close($conn);
}

?>