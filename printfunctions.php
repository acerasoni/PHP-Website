<?php

function artDropDown($conn)
{
	echo ' <label>Artist: </label></br>';  
	echo '<select name="artID">';

	$array_result = array();
	$sql = "SELECT `artName` from `artist`";
	$result5 = mysqli_query($conn,  $sql);

	if($result5){
		
		while($cRow = mysqli_fetch_array($result5))
		{
			$array_result[] = $cRow;

		}
		foreach($array_result as $rowz){
			echo '<option value="'.$rowz['artName'].'">'.$rowz['artName'].'</option>';
		}}
	else{
		echo "Error";
	}

	echo '</select><br />';
}


function albumDropDown($conn)
{
	echo ' <label>Album: </label></br>';  
	echo '<select name="cdTitle">';

	$array_result = array();
	$sql = "SELECT `cdTitle` from `cd`";
	$result5 = mysqli_query($conn,  $sql);

	if($result5){
		
		while($cRow = mysqli_fetch_array($result5))
		{
			$array_result[] = $cRow;

		}
		foreach($array_result as $rowz){
			echo '<option value="'.$rowz['cdTitle'].'">'.$rowz['cdTitle'].'</option>';
		}}
	else{
		echo "Error";
	}

	echo '</select><br />';
}

?>