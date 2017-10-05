
<html><body>

<form action="" method="POST">
<input id="search" name="album" type="text" placeholder="Type here">
<input id="submit" type="submit" value="Search Album">
</form>
</body></html>

<?php

include 'db.php'; // include our database connection
include 'errors.php'; // include our error checking functions
include 'printfunctions.php'; // includes our print functions

$q = $_GET['q']; // gets the query search number, 0 means no query 

$error = $_GET['error'];

printError($error);
if($error == 0){
	if($q==0){
		if(isset($_POST["album"])){


			$res =  $_POST["album"];

			$sql = "SELECT * FROM cd WHERE cdTitle LIKE '%$res%'";

			cdTable($sql,$conn);
		}

		else{
			$sql = "SELECT * FROM cd";

			cdTable($sql,$conn);
		}
	}
	else{
		$sql = "SELECT * FROM cd WHERE artID = '$q'";
		cdTable($sql,$conn);
		echo "</br>";
		echo "<form method='POST'>
<input type='submit' name='Button2' value='Return to Artist Index'>
</form>";
		if(isset($_POST['Button2'])){
			header("Location: /?page=artists");
		}
	}}

echo "</br>";
mysqli_close($conn);


function cdTable($sql, $conn) // Connects to database and prints album table
{
	$sqltest = mysqli_query($conn, "SELECT * FROM cd");
	if(mysqli_num_rows($sqltest)>0){
		$array_res = array();
		$res = mysqli_query($conn,$sql);
		while($cRow = mysqli_fetch_array($res))
		{
			$array_res[] = $cRow;
		}

		echo '<div class="w3-container"><table id= "tavola" class="w3-table w3-striped"><tr><th>Album ID</th><th>Artist Name</th><th>Title</th><th>Price(£)</th><th>Genre</th><th>N# of Tracks</th><th>Features</th></tr>';
		asort($array_res);
		foreach ($array_res as $row) 
		{ 
			$tmpart = $row['artID'];
			$continue = "SELECT artName from artist WHERE artID='$tmpart'";
			$result3 = mysqli_query($conn, $continue);
			while($row2 = mysqli_fetch_assoc($result3)){
				$artIDone = $row2['artName'];
			}
			if($row['cdNumTracks']==0)
			$row['cdNumTracks'] = "No tracks available.";
			
			echo '<tr>';
			echo '<td>' . $row['cdID'] . '</td>';
			echo '<td>' . $artIDone . '</td>';
			echo '<td>' . $row['cdTitle'] . '</td>';
			echo '<td>' . $row['cdPrice'] . '</td>';
			echo '<td>' . $row['cdGenre'] . '</td>';
			echo '<td>' . $row['cdNumTracks'] . '</td>';
			echo "<td><a href='/?page=edit-album" . "&num=" . urlencode($row['cdID']). "'>Edit</a>
		<a href='/?page=tracks&q=" . urlencode($row['cdID']) . "&error=0". "'>Tracks</a></td>";
			
			echo '</tr>';

			
		}
		
		echo "</table></div>";
	}
	else{
		echo '<br></br>';
		echo '<font size="6" face="Arial">';
		echo '<strong>';
		echo 'Album database is empty';
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
<input type="checkbox" onclick="display(this)">Add Album</input>
<div id="yourDiv"class="toshow" style="display:none"> 

<div class="container">
<form action="insertcd.php">
<?php 
include 'db.php';
artDropDown($conn);?>
<label>Title: </label>
<input type="text" name="cdTitle"><br />
<label>Price (Numeric type only): </label>
<input type="text" name="cdPrice"><br />
<label>Genre: </label></br>
<select name="cdGenre">
<option value="Rock">Rock</option>
<option value="Pop">Pop</option>
<option value="Electronica">Electronica</option>
<option value="Alternative Rock">Alternative Rock</option>
</select></br>
<p>
<input type="submit" value="Insert" />
</p>
</form>
</div>
</div>
