<?php
include 'db.php'; // include our database connection
$artID = $_GET['artID'];
$cdTitle = $_GET['cdTitle'];
$cdPrice = $_GET['cdPrice'];
$cdGenre = $_GET['cdGenre'];
$cdID = $_GET['cdID'];
$artcheck = "SELECT artID from artist WHERE artID = '$artID'";
$result = mysqli_query($conn, $artcheck);

if(mysqli_num_rows($result)==0){
	header("Location: /?page=albums&error=1");
}

else{
	$sql = "UPDATE cd SET artID='$artID', cdTitle='$cdTitle', cdPrice='$cdPrice', cdGenre='$cdGenre' WHERE cdID='$cdID' ";
	if($result = mysqli_query($conn,$sql)){
		header("Location: /?page=albums&error=0"); /* Redirect browser */
		exit();
	}	else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);}
	mysqli_close($conn);
}
?>