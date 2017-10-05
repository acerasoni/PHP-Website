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
include 'printfunctions.php'; // includes our print functions

$trackID= $_GET['id'];

$sql = "SELECT title FROM tracks WHERE trackID = '$trackID'";
$result = mysqli_query($conn,$sql);
while($row2 = mysqli_fetch_assoc($result)){
	$name = $row2['title'];
}

$sql2 = "SELECT artName FROM tracks WHERE trackID = '$trackID'";
$result2 = mysqli_query($conn,$sql2);
while($row2 = mysqli_fetch_assoc($result2)){
	$artist = $row2['artName'];
}


$sql3 = "SELECT cdTitle FROM tracks WHERE trackID = '$trackID'";
$result3 = mysqli_query($conn,$sql3);
while($row2 = mysqli_fetch_assoc($result3)){
	$cdTitle2= $row2['cdTitle'];
}

$sql4 = "SELECT duration FROM tracks WHERE trackID = '$trackID'";
$result4 = mysqli_query($conn,$sql4);
while($row2 = mysqli_fetch_assoc($result4)){
	$duration2 = $row2['duration'];
}
echo '<font size="6" face="Arial">';
echo '<strong>';
echo "$name ";
echo '</strong>';
echo '</font>';
echo "(Leave fields empty to maintain current data)";


if(isset($_POST["insertion"])){
	
	
	$title = $_POST['title'];
	$cdTitle = $_POST['cdTitle'];
	$duration = $_POST['duration'];

	if(!$title || !$cdTitle || !$duration){
			if(!$title)
			$title = $name;
			if(!$cdTitle)
			$cdTitle = $cdTitle2;
		    if(!$duration)
			$duration = $duration2;
			
		}
	

	if(is_numeric($duration)){
	

			$sql8 = "UPDATE cd SET cdNumTracks = (cdNumTracks + 1) WHERE cdTitle = '$cdTitle'";
			$sql9 = "UPDATE cd SET cdNumTracks = (cdNumTracks - 1) WHERE cdTitle = '$cdTitle2'";			
			$sql = "UPDATE tracks SET title='$title',  cdTitle='$cdTitle', duration='$duration' WHERE trackID='$trackID'";
     if($cdTitle2 != $cdTitle){
		     $res4 = mysqli_query($conn, $sql8);
			 $res5 = mysqli_query($conn, $sql9);
	 }
				if($final = mysqli_query($conn,$sql)){
				header("Location: /?page=tracks&error=0&q=0");
				die();
			}else{
				header("Location: /?page=tracks&error=1&q=0");
			}
	}
	else{
		header("Location: /?page=tracks&error=3&q=0");
	}
	
}

if(isset($_POST['Button'])){
	$sql1 = "DELETE FROM tracks WHERE trackID = '$trackID' ";
	$sql2 = "ALTER TABLE tracks AUTO_INCREMENT = 1 ";
	$sql3 = "UPDATE cd SET cdNumTracks = (cdNumTracks - 1) WHERE cdTitle = '$cdTitle2'";
	$resultnew= mysqli_query($conn,$sql3);
	$res1 = mysqli_query($conn,$sql1);
	$res2 = mysqli_query($conn,$sql2);
	header("Location: /?page=tracks&error=0&q=0");
	die();
}
if(isset($_POST['Button2'])){

	header("Location: /?page=tracks&error=0&q=0");

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
<label>Title: </label>
<input type="text" name="title" placeholder="<?php echo $name; ?>"><br />
<?php 
include 'db.php';

albumDropDown($conn);?>
<label>Duration: </label>
<input type="text" name="duration" placeholder = "<?php echo $duration2; ?>"><br />
<p>
<input type="submit" name="insertion" value="Insert" />
</p>
</form>
</div>

<form action= "" method="POST">
<input type="submit" name="Button" value="Delete">
(Deleting an Artist will automatically delete its albums.)
</form>
</button>
<form action= "" method="POST">
<input type="submit" name="Button2" value="Return to Tracks Index">
</form>
</button><br></br>