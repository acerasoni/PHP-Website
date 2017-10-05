
<html><body>
<?php
echo '<strong><font size="6">Database Statistics</font></strong>';
include 'db.php'; // include our database connection
$sql = "SELECT * FROM artist";

if($result = mysqli_query($conn, $sql)){
	$num = mysqli_num_rows($result);
	echo "<table><ul><li>Number of Artists: " . $num . "</li>";
	mysqli_free_result($result);
}

$sql = "SELECT * FROM cd";

if($result = mysqli_query($conn, $sql)){
	$num = mysqli_num_rows($result);
	echo '<li>Number of CDs: ' . '   ' .  $num . '</li>';
	mysqli_free_result($result);
}

$sql = "SELECT * FROM tracks";

if($result = mysqli_query($conn, $sql)){
	$num = mysqli_num_rows($result);
	echo "<li>Number of Tracks: " . $num . "</li></ul></table>";
	mysqli_free_result($result);
}

mysqli_close($conn);

?>
</body></html>