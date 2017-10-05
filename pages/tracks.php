
<html><body>

<form action="" method="POST">
<input id="search" name="album" type="text" placeholder="Type here">
<input id="submit" type="submit" value="Search Track">
</form>
</body></html>

<?php

include 'db.php'; // include our database connection
include 'errors.php'; //include our error checking functions
include 'printfunctions.php';// includes our print functions

$q = $_GET['q'];
$error = $_GET['error'];

printError($error);
if($error == 0){
	if($q != 0){
		$sql0 = "SELECT cdTitle from cd WHERE cdID = '$q'";
		$result4 = mysqli_query($conn,$sql0);
		while($row2 = mysqli_fetch_assoc($result4)){
			$cdname = $row2['cdTitle'];
		}
		$sql = "SELECT * FROM tracks WHERE cdTitle = '$cdname'";

		trackTable($sql,$conn);
		echo "</br>";
		echo "<form method='POST'>
<input type='submit' name='Button2' value='Return to Artist Index'>
</form>";
		if(isset($_POST['Button2'])){
			header("Location: /?page=artists");
		}
	}
	else{
		if(isset($_POST["album"])){

			$res =  $_POST["album"];
			$sql = "SELECT * FROM tracks WHERE title LIKE '%$res%'";

			trackTable($sql,$conn);
		}

		else{
			$sql = "SELECT * FROM tracks";

			trackTable($sql,$conn);
		}
	}
}
echo "</br>";
mysqli_close($conn);

function trackTable($sql, $conn)
{
	$sqltest = mysqli_query($conn, "SELECT * FROM tracks");
	if(mysqli_num_rows($sqltest)>0){
		$array_res = array();
		$res = mysqli_query($conn,$sql);
		while($cRow = mysqli_fetch_array($res))
		{
			$array_res[] = $cRow;
		}

		echo '<div class="w3-container"><table id= "tavola" class="w3-table w3-striped"><tr><th>Track ID</th><th>Title</th><th>Artist</th><th>Album</th><th>Duration</th><th>Features</th></tr>';
		asort($array_res);
		foreach ($array_res as $row) 
		{ 
			echo '<tr>';
			echo '<td>' . $row['trackID'] . '</td>';
			echo '<td>' . $row['title'] . '</td>';
			echo '<td>' . $row['artName'] . '</td>';
			echo '<td>' . $row['cdTitle'] . '</td>';
			echo '<td>' . $row['duration'] . '</td>';
			echo "<td><a href='/?page=edit-track&id=" . urlencode($row['trackID']) ."&page=" . 'edit-track' . "'>Edit</a></td>";			
			echo '</tr>';			
		}
		
		echo "</table></div>";
	}else{
		echo '<br></br>';
		echo '<font size="6" face="Arial">';
		echo '<strong>';
		echo 'Track database is empty';
		echo '</strong>';
		echo '<br></br>';
		echo '</font>';
	}
}

?><script language='javascript'>


function display(e){
	if (e.checked)
	document.getElementById('yourDiv').style.display = 'block';
	else
	document.getElementById('yourDiv').style.display = 'none';
}
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
<input type="checkbox" onclick="display(this)">Add Track</input>
<div id="yourDiv"class="toshow" style="display:none"> 

<div class="container">
<form action="inserttrack.php">
<label>Title: </label>
<input type="text" name="title"><br />
<?php 
include 'db.php';
albumDropDown($conn);?>
<label>Duration (Numeric type only): </label>
<input type="text" name="duration"><br />
<p>
<input type="submit" value="Insert" />
</p>
</form>
</div>
</div>
