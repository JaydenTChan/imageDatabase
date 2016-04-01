<?php
/*
Created by JaydenTChan 2016-03-30
A lot of the code is referenced from the SQL examples as provided by eclass
*/
include("PHPconnectionDB.php");

function indexImages(){
	//establish connection
	$conn=connect();
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	$sql = array(
	'ALTER INDEX subjectIndex REBUILD',
	'ALTER INDEX placeIndex REBUILD',
	'ALTER INDEX descriptionIndex REBUILD');

	for ($counter = 1; $counter < 4; $counter++){
		//Prepare sql using conn and returns the statement identifier
		$stid = oci_parse($conn, $sql[$counter]);
		//Execute a statement returned from oci_parse()
		$res=oci_execute($stid);
	
		if (!$res) {
			//Error Message
			$message = "Server busy";
			echo "<script type='text/javascript'>";
			echo "alert('$message');";
			echo "window.location.href = \"../login.html\";";
			echo "</script>";
		}
	}
	
	// Free the statement identifier when closing the connection
	oci_free_statement($stid);
	oci_close($conn);
	
	return;
}
?>
