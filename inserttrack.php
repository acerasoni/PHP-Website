<?php
include 'db.php'; // include our database connection
$title = $_GET['title'];
$cdtitle = $_GET['cdTitle'];
$duration = $_GET['duration'];if(!$title || !$cdtitle || !$duration){
	header("Location: /?page=tracks&error=2&q=0");
}
else{
         if(is_numeric($duration)){
			$sqlfirst = "UPDATE cd SET cdNumTracks = (cdNumTracks + 1) WHERE cdTitle = '$cdtitle'";
			$resultnew= mysqli_query($conn,$sqlfirst);
			
			$sqlnew = "SELECT artID from cd WHERE cdTitle = '$cdtitle'";
			$result5 = mysqli_query($conn,  $sqlnew);
		    
		
		while($cRow = mysqli_fetch_array($result5))
		{
			$tmpvalue = $cRow['artID'];
		}
		
		$sqlnew3 = "SELECT artName from artist WHERE artID = '$tmpvalue'";
			$result6 = mysqli_query($conn,  $sqlnew3);
			
			while($cRow = mysqli_fetch_array($result6))
		{
			$tmpvalue2 = $cRow['artName'];
		}
			
			$sql = "INSERT INTO tracks (title, artName, cdTitle, duration) VALUES ('$title',
'$tmpvalue2', '$cdtitle', '$duration')";
			if(mysqli_query($conn,$sql)){
				header("Location: /?page=tracks&error=0&q=0"); /* Redirect browser */
				exit();
			}	else {
				header("Location: /?page=tracks&error=1&q=0");}
		
}
else{
		header("Location: /?page=tracks&error=3&q=0");
}
}

mysqli_close($conn);

?>