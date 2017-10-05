
<html><body>

<form action="" method="POST">
<input id="search" name="artist" type="text" placeholder="Type here">
<input id="submit" type="submit" value="Search Artist">
</form>
</body></html>

<?php

include 'db.php'; // include our database connection
include 'errors.php'; //include our error checking functions
$error = $_GET['error'];

printError($error);
if($error == 0){
	if(isset($_POST["artist"])){


		$res =  $_POST["artist"];

		$sql = "SELECT * FROM artist WHERE artName LIKE '%$res%'";


		artistTable($sql,$conn);

	}
	else{
		$sql = "SELECT * FROM artist";

		artistTable($sql,$conn);
	}
	echo "</br>";
	mysqli_close($conn);
}


function artistTable($sql, $conn)
{
	$array_res = array();
	$res = mysqli_query($conn,$sql);
	if($count = mysqli_num_rows($res) > 0){
		while($cRow = mysqli_fetch_array($res))
		{
			$array_res[] = $cRow;
		}

		echo '<div class="w3-container"><table id= "tavola" class="w3-table w3-striped"><tr><th>Artist ID</th><th>Artist Name</th><th>Features</th></tr>';
		asort($array_res);
		foreach ($array_res as $row) 
		{ 
			echo '<tr>';
			echo '<td>' . $row['artID'] . '</td>';
			echo '<td>' . $row['artName'] . '</td>';
			echo "<td><a href='/?page=edit-artist&id=" . urlencode($row['artName']) ."'>Edit</a></td>";
			echo "<td><a href='/?page=albums&error=0&q=" . urlencode($row['artID']) . "'>Albums</a></td>";
			echo '</tr>';	
		}
		echo "</table></div>";
	}
	else{
		$sqltest = mysqli_query($conn, "SELECT * FROM artist");
		if(mysqli_num_rows($sqltest)>0){
			echo '<br></br>';
			echo '<font size="6" face="Arial">';
			echo '<strong>';
			echo 'Artist does not exist in database, try again.';
			echo '</strong>';
			echo '<br></br>';
			echo '</font>';
		}
		else{
			echo '<br></br>';
			echo '<font size="6" face="Arial">';
			echo '<strong>';
			echo 'Artist database is empty.';
			echo '</strong>';
			echo '<br></br>';
			echo '</font>';
		}
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

<input type="checkbox" onclick="display(this)">Add Artist</input>
<div id="yourDiv"class="toshow" style="display:none"> 


<form action="insertartist.php">
<p>
Artist Name: 
<input type="text" name="artName" />
</p>
<p>
<input type="submit" value="Insert" />
</p>
</form>
</div>
