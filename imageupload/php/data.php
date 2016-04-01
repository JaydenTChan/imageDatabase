<?php
/*
	Some implementation borrowed from https://github.com/DT9/391_photoshare/blob/master/datacube1.php
	We own no portion of the borrowed implementation
*/

/* ================ Main Data Grabber ================ */
function getData($user, $subject, $date, $to_date, $fr_date){
	//This function takes in the following and echoes out a formatted table
	$label = $date;
	
	$SELECT = "SELECT ";
	$WHERE = " WHERE ";
	$GROUP = " GROUP BY ";
	
	if($user == "All"){
		$SELECT .= "owner_name, ";
		$GROUP .= "owner_name, ";
	}else if($user == "None"){
		//Don't add anything
	}else{
		$SELECT .= "owner_name, ";
		$GROUP .= "owner_name, ";
		$WHERE .= "'".$user."' = owner_name AND ";
	}
	
	if($subject == 'ALL'){
		$SELECT .= " subject as sub, ";
		$GROUP .= " subject, ";
	}else if($subject == ""){
		//Don't add anything
	}else{
		$SELECT .= " subject as sub, ";
		$WHERE .= "subject like '%" .$subject. "%' AND ";
		$GROUP .= " subject, ";
	}
	
	if($date == 'Weekly'){
		$SELECT .= "to_char(timing, 'yyyy-MON-IW') as time, ";
		$GROUP .= "to_char(timing, 'yyyy-MON-IW'), ";
	}else if($date == 'Monthly'){
		$SELECT .= "to_char(timing, 'yyyy-MON') as time, ";
		$GROUP .= "to_char(timing, 'yyyy-MON'), ";
	}else if($date == 'Yearly'){
		$SELECT .= "to_char(timing, 'yyyy') as time, ";
		$GROUP .= "to_char(timing, 'yyyy'), ";
	}else{
		//No grouping
	}
	
	if($to_date != ""){
		$WHERE .= " timing <= TO_DATE('".$to_date."', 'DD-MM-YYYY') AND";
	}
	
	if($fr_date != ""){
		$WHERE .= " timing >= TO_DATE('".$fr_date."', 'DD-MM-YYYY')";
	}
	
	//Make sure to count the amount of photos
	$SELECT .= " count(photo_id) as counted";
	
	$WHERE = rtrim($WHERE, " WHERE");
	$WHERE = rtrim($WHERE, " AND");
	$GROUP = rtrim($GROUP, ", ");
	
	$QUERY = $SELECT." FROM images ".$WHERE.$GROUP;
	
	echo "<br>";
	echo "<br>";
	echo "<br>";
	
	$conn=connect();
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	
	//Prepare sql using conn and returns the statement identifier
	$stid = oci_parse($conn, $QUERY);
	//Execute a statement returned from oci_parse()
	$res=oci_execute($stid);
	
	if (!$res) {
		//Error Message
		$message = "Server busy";
		echo "<script type='text/javascript'>";
		echo "alert('$message');";
		echo "window.location.href = \"login.html\";";
		echo "</script>";
	}else{
	
		echo '
		<TABLE style="width:100%" class="results">
		<COL ALIGN="left">
		<COL ALIGN="left">';
		if($subject!="")	{
			echo'<COL ALIGN="left">';
		}
		echo '
		<COL ALIGN="right">
		<tr>
		<td>Owner</td> ';
			
		if($subject!="")	{
			echo'<td>Subject</td> ';
		}
	
		echo'
			<td>Grouping: ' .$label. '</td> 
			<td>Image Count</td>
		</tr>
		';
		//class="results2"
		
		while($row = oci_fetch_array($stid, OCI_ASSOC)){
			echo '<TR>';

			echo '<TD>'.$row["OWNER_NAME"].'</TD>';
			
			if($subject!="")	{
				echo '<TD>'.$row["SUB"].'</TD>';
			}
			echo '<TD>'.$row["TIME"].'</TD>';
			echo '<TD>'.$row["COUNTED"].'</TD>';
			echo "</TR>";
		}
		echo '</TABLE>';
	}
	
	// Free the statement identifier when closing the connection
	oci_free_statement($stid);
	oci_close($conn);
	
	return;
}

/* ================ Supplementary ================ */
function populateUsers(){
	//This function gets all the groups on the system

	//establish connection
	$conn=connect();
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	
	$sql = 'SELECT user_name FROM users';

	//Prepare sql using conn and returns the statement identifier
	$stid = oci_parse($conn, $sql);
	//Execute a statement returned from oci_parse()
	$res=oci_execute($stid);

	if (!$res) {
	
		//Error Message
		$message = "Server busy";
		echo "<script type='text/javascript'>";
		echo "alert('$message');";
		echo "window.location.href = \"../login.html\";";
		echo "</script>";
	}else{
		while($row = oci_fetch_row($stid)){
			echo '<option value="' . $row[0] .'">' .$row[0]. '</option>';
		}
	}
	
	// Free the statement identifier when closing the connection
	oci_free_statement($stid);
	oci_close($conn);
	
	return;
}

/* ================ Extras ================ */

function getViews(){
	//This function gets all the groups on the system

	//establish connection
	$conn=connect();
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	
	$sql = 'SELECT COUNT(*) FROM image_views';

	//Prepare sql using conn and returns the statement identifier
	$stid = oci_parse($conn, $sql);
	//Execute a statement returned from oci_parse()
	$res=oci_execute($stid);

	if (!$res) {
	
		//Error Message
		$message = "Server busy";
		echo "<script type='text/javascript'>";
		echo "alert('$message');";
		echo "window.location.href = \"../login.html\";";
		echo "</script>";
	}else{
		$row = oci_fetch_row($stid);
		echo '<p class="dropdown">Total Image Views: ' .$row[0]. '</p>';
	}
	
	// Free the statement identifier when closing the connection
	oci_free_statement($stid);
	oci_close($conn);
	
	return;
}

function getUserCount(){
	//This function gets all the users on the system

	//establish connection
	$conn=connect();
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	
	$sql = 'SELECT COUNT(*) FROM users';

	//Prepare sql using conn and returns the statement identifier
	$stid = oci_parse($conn, $sql);
	//Execute a statement returned from oci_parse()
	$res=oci_execute($stid);

	if (!$res) {
	
		//Error Message
		$message = "Server busy";
		echo "<script type='text/javascript'>";
		echo "alert('$message');";
		echo "window.location.href = \"../login.html\";";
		echo "</script>";
	}else{
		$row = oci_fetch_row($stid);
		echo '<p class="dropdown">Total Users: ' .$row[0]. '</p>';
	}
	
	// Free the statement identifier when closing the connection
	oci_free_statement($stid);
	oci_close($conn);
	
	return;
}

function getImageCount(){
	//This function gets all the groups the user owns

	//establish connection
	$conn=connect();
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	
	$sql = 'SELECT COUNT(*) FROM images';

	//Prepare sql using conn and returns the statement identifier
	$stid = oci_parse($conn, $sql);
	//Execute a statement returned from oci_parse()
	$res=oci_execute($stid);

	if (!$res) {
	
		//Error Message
		$message = "Server busy";
		echo "<script type='text/javascript'>";
		echo "alert('$message');";
		echo "window.location.href = \"../login.html\";";
		echo "</script>";
	}else{
		$row = oci_fetch_row($stid);
		echo '<p class="dropdown">Total Images: ' .$row[0]. '</p>';
	}
	
	// Free the statement identifier when closing the connection
	oci_free_statement($stid);
	oci_close($conn);
	
	return;
}


?>