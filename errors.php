<?php
function printError($validation)
{
	if($validation == 1){
		echo '<br></br>';
		echo '<font size="6" face="Arial">';
		echo '<strong>';
		echo 'ERROR: Duplicate entry.';
		echo '</strong>';
		echo '</font>';
		echo '</br>';
		echo "<a href='/?page=home'><input type='button' value='Back to Home' /></a>";
		echo '<br></br>';
	}else if($validation == 2){
		echo '<br></br>';
		echo '<font size="6" face="Arial">';
		echo '<strong>';
		echo 'ERROR: Cannot leave empty field.';
		echo '</strong>';
		echo '</font>';
		echo '</br>';
		echo "<a href='/?page=home'><input type='button' value='Back to Home' /></a>";
		echo '<br></br>';
	}
	else if($validation == 3){
		echo '<br></br>';
		echo '<font size="6" face="Arial">';
		echo '<strong>';
		echo 'ERROR: Enter number in according field.';
		echo '</strong>';
		echo '</font>';
		echo '</br>';
		echo "<a href='/?page=home'><input type='button' value='Back to Home' /></a>";
		echo '<br></br>';
	}

}
?>