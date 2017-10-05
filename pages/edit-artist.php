<head>
<style>
body {
	background-image: linen;
}

h1 {
color: maroon;
	margin-left: 40px;
} 
</style>
</head>
<?php

include "db.php";
$artName = $_GET['id'];
echo '<font size="6" face="Arial">';
echo '<strong>';
echo $artName;
echo '</strong>';
echo '</font>';
echo ' (Leave field empty to maintain current name.)';
echo '<br></br>';



$sql = "SELECT artID FROM artist WHERE artName = '$artName'";
$result = mysqli_query($conn,$sql);
while($row2 = mysqli_fetch_assoc($result)){
	$artID = $row2['artID'];
}

if(isset($_POST["artist"])){
	if(!empty($_POST["artist"]))
		$res = $_POST["artist"];
	else
		$res = $artName;
		
		$sqlsecure = "SET foreign_key_checks = 0";
		$finals = mysqli_query($conn,$sqlsecure);
			
		$sqlnull = "UPDATE tracks SET artName = '$res' WHERE artName LIKE '%$artName%'";
		$sql = "UPDATE artist SET artName = '$res' WHERE artName LIKE '%$artName%'";
		
		if($final = mysqli_query($conn,$sql)){
			$sqlsecure = "SET foreign_key_checks = 1";
		$finals = mysqli_query($conn,$sqlsecure);
			$sqllol = "UPDATE tracks SET artName='$res'";
			$results = mysqli_query($conn, $sqllol);
			header("Location: /?page=artists&error=0");
		}else{
			$sqlsecure = "SET foreign_key_checks = 1";
		$finals = mysqli_query($conn,$sqlsecure);
			
			header("Location: /?page=artists&error=1");
		}

		die();
	
}

if(isset($_POST['Button'])){
	$sqlcheck = "SELECT * FROM tracks WHERE artName='$artName'";
	if($results = mysqli_query($conn, $sqlcheck)){
	$sql1 = "DELETE FROM tracks WHERE artName = '$artName' ";
	$sql2 = "DELETE FROM cd WHERE artID = '$artID' ";
	$sql3 = "DELETE FROM artist WHERE artName = '$artName' ";
	$sql4 = "ALTER TABLE artist AUTO_INCREMENT = 1 ";
	$sql5 = "ALTER TABLE cd AUTO_INCREMENT = 1";
	$sql6 = "ALTER TABLE tracks AUTO_INCREMENT = 1";
	$res1 = mysqli_query($conn,$sql1);
	$res2 = mysqli_query($conn,$sql2);
	$res3 = mysqli_query($conn,$sql3);
	$res4 = mysqli_query($conn,$sql4);
	$res5 = mysqli_query($conn,$sql5);
	$res6 = mysqli_query($conn,$sql6);
	header("Location: /?page=artists&error=0");
	die();
}
	else{
		
	$sql1 = "DELETE FROM cd WHERE artID = '$artID' ";
	$sql2 = "DELETE FROM artist WHERE artName = '$artName' ";
	$sql3 = "ALTER TABLE artist AUTO_INCREMENT = 1 ";
	$sql4 = "ALTER TABLE cd AUTO_INCREMENT = 1";
	$res1 = mysqli_query($conn,$sql1);
	$res2 = mysqli_query($conn,$sql3);
	$res3 = mysqli_query($conn,$sql4);
	$res4 = mysqli_query($conn,$sql5);

	header("Location: /?page=artists&error=0");
	die();
	}
}

if(isset($_POST['Button2'])){

	header("Location: /?page=artists&error=0");
	die();
}
?>

<form action="" method="POST">
<input name="artist" type="text" placeholder = "<?php echo $artName;?>" >
<input id="submit" type="submit" value="Change name">
</form></br>
<form action= "" method="POST">
<input type="submit" name="Button" value="Delete">
(Deleting an Artist will automatically delete its albums.)
</form>
</button>
<form action= "" method="POST">
<input type="submit" name="Button2" value="Return to Artist Index">
</form>
</button><br></br>