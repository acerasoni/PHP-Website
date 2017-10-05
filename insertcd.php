<?php
include 'db.php'; // include our database connection
$artName = $_GET['artID'];
$cdTitle = $_GET['cdTitle'];
$cdPrice = $_GET['cdPrice'];
$cdGenre = $_GET['cdGenre'];
$artcheck = "SELECT artID from artist WHERE artName = '$artName'";
$result = mysqli_query($conn, $artcheck);
	while($row2 = mysqli_fetch_assoc($result)){
		$artID = $row2['artID'];
	}
	
	if(!$artName || !$cdTitle || !$cdPrice || !$cdGenre){
		header("Location: /?page=albums&error=2&q=0");
	}

	else{
	if(is_numeric($cdPrice)){
		
		$sql = "INSERT INTO cd (artID, cdTitle, cdPrice, cdGenre, cdNumTracks) VALUES ('$artID',
'$cdTitle', '$cdPrice', '$cdGenre',0)";

		if(mysqli_query($conn,$sql)){
			header("Location: /?page=albums&error=0&q=0"); /* Redirect browser */
			exit();
		}	else {
			header("Location: /?page=albums&error=1&q=0");}
		mysqli_close($conn);

	}
	else{
		header("Location: /?page=albums&error=3&q=0");
	}
	}
?>