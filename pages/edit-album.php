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
include "db.php"; // includes our database connection
include 'printfunctions.php';// includes our print functions

$cdID = $_GET['num'];

$sqlname = "SELECT cdTitle from cd WHERE (cdID = '$cdID')";
$result = mysqli_query($conn, $sqlname);
while($row = mysqli_fetch_assoc($result)){
	$cdTitle = $row['cdTitle'];
}

echo '<font size="6" face="Arial">';
echo '<strong>';
echo "$cdTitle ";
echo '</strong>';
echo '</font>';
echo ' (Leave fields empty to maintain current data)';



$sql = "SELECT cdPrice from cd WHERE (cdID = '$cdID')";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
	$cdPrice = $row['cdPrice'];
}


$sqlnew = "SELECT artID from cd WHERE cdTitle = '$cdTitle'";
$result = mysqli_query($conn, $sqlnew);
while($row = mysqli_fetch_assoc($result)){
	$cdIDtest = $row['artID'];
}

$sqlold = "SELECT artName from artist WHERE artID = '$cdIDtest'";
$result = mysqli_query($conn, $sqlold);
while($row = mysqli_fetch_assoc($result)){
	$artName = $row['artName'];
}

$sqlthis = "SELECT cdGenre from cd WHERE cdTitle = '$cdTitle'";
$result = mysqli_query($conn, $sqlthis);
while($row = mysqli_fetch_assoc($result)){
	$cdGenre= $row['cdGenre'];
}



if(isset($_POST["insertion"])){
	
	
	$artName = $_POST['artID'];
	$cdTitle1 = $_POST['cdTitle'];
	$cdPrice1 = $_POST['cdPrice'];
	$cdGenre1 = $_POST['cdGenre'];

	
	if(!$artName || !$cdTitle1 || !$cdPrice1 || !$cdGenre1){
		if(!$cdTitle1)
			$cdTitle1 = $cdTitle;
		if(!$artName1)
			$artName1 = $artName;
		if(!$cdPrice1)
			$cdPrice1 = $cdPrice;
		if(!$cdGenre1)
			$cdGenre1 = $cdGenre;
	}

	if(is_numeric($cdPrice1)){
			$sql1 = "SELECT artID from artist WHERE artName='$artName'";
			$resultfinal= mysqli_query($conn, $sql1);
			while($row = mysqli_fetch_assoc($resultfinal)){
				$artIDNew = $row['artID'];
			}
			$sqllol= "UPDATE tracks SET cdTitle = '$cdTitle1'";
			$sql = "UPDATE cd SET artID='$artIDNew', cdTitle='$cdTitle1', cdPrice='$cdPrice1', cdGenre='$cdGenre1' WHERE cdID='$cdID'";
			$sql2 = "SET foreign_key_checks = 0";
			if($finals2 = mysqli_query($conn,$sql2)){
			if($final = mysqli_query($conn,$sql)){
				$sql3="SET foreign_key_checks = 1";
				$results = mysqli_query($conn, $sqllol);
				$end = mysqli_query($conn, $sql3);
			header("Location: /?page=albums&error=0&q=0");
			die();
			}
			else{
				$sql3 = "SET foreign_key_checks = 1";
			$finals = mysqli_query($conn,$sql3);
				header("Location: /?page=albums&error=1&q=0");
				die();
			}}
			else{
				$sql3 = "SET foreign_key_checks = 1";
			$finals = mysqli_query($conn,$sql3);
				header("Location: /?page=albums&error=1&q=0");
				die();
			}
	}
	else{
		header("Location: /?page=albums&error=3&q=0");
	}
	

}

if(isset($_POST['Button'])){
    $sql1 = "DELETE FROM tracks WHERE cdTitle = '$cdTitle' ";
	$sql2 = "DELETE FROM cd WHERE cdID = '$cdID' ";
	$sql3 = "ALTER TABLE cd AUTO_INCREMENT = 1 ";
	$sql4 = "ALTER TABLE tracks AUTO_INCREMENT = 1 ";
	$res1 = mysqli_query($conn,$sql1);
	$res2 = mysqli_query($conn,$sql2);
	$res3 = mysqli_query($conn,$sql3);
	$res4 = mysqli_query($conn,$sql4);
	header("Location: /?page=albums&error=0&q=0");
	die();
}
if(isset($_POST['Button2'])){

	header("Location: /?page=albums&error=0&q=0");
	die();
}

?>
</script>
<style type="text/css">
.container {
width: 500px;
clear: both;
}
.container input {
width: 100%;
clear: both;
}

</style>

<div class="container">
<form  method="POST">
<?php 
include 'db.php';
artDropDown($conn);
?>
<label>Title: </label>
<input type="text" name="cdTitle" placeholder ="<?php echo $cdTitle; ?>"><br />
<label>Price: </label>
<input type="text" name="cdPrice" placeholder = "<?php echo $cdPrice; ?>"><br />
<label>Genre: </label></br>
<select name="cdGenre">
<option value="Rock">Rock</option>
<option value="Pop">Pop</option>
<option value="Electronica">Electronica</option>
<option value="Alternative Rock">Alternative Rock</option>
</select></br>
<label>Album ID (Cannot change): </label></br>
<input disabled type="text" name="cdID" placeholder = "<?php echo $cdID; ?>"><br />
<p>
<input type="submit" name="insertion" value="Insert" />
</p>
</form>
</div>
<form action= "" method="POST">
<input type="submit" name="Button" value="Delete">
<?php echo '(Deleting an Album will automatically delete its Tracks)';?>
</form>
</button>
<form action= "" method="POST">
<input type="submit" name="Button2" value="Return to Album Index">
</form>
</button><br></br>