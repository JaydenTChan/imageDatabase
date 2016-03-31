<?php
include("PHPconnectionDB.php");

function getUserOwnerGroups(){
	//This function gets all the groups the user owns
	session_start();

	//establish connection
	$conn=connect();
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	$sql = 'SELECT * FROM groups WHERE user_name = \'' . $_SESSION["user"] . '\'';

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
		echo "<select name=\"groupList\">";
		
		while($row = oci_fetch_row($stid)){
			//Loop until no more rows
			echo "<option value=\"" . $row[0] . "\">" . $row[2] . "</option>";
		}
		echo "</select>";
	}

	
	// Free the statement identifier when closing the connection
	oci_free_statement($stid);
	oci_close($conn);
	
	return;
}

function getUserGroups(){
	//This function gets all the groups the user belongs to
	//This function will return ALL groups to the admin (Admin may view any image)
	session_start();

	//establish connection
	$conn=connect();
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	
	//Get the groups where the owner is part of a group
	$sql = 'SELECT group_id, group_name FROM group_lists, groups 
	WHERE friend_id = user_name
	AND friend_id = \'' . $_SESSION["user"] . '\'';

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
		echo "<select name=\"groupList\">";
		
		while($row = oci_fetch_row($stid)){
			//Loop until no more rows
			echo "<option value=\"" . $row[0] . "\">" . $row[2] . "</option>";
		}
		echo "</select>";
	}

	
	// Free the statement identifier when closing the connection
	oci_free_statement($stid);
	oci_close($conn);
	
	return;
}

function createGroup(){
	//This function is used to create new groups
	session_start();
	$groupName = $_POST['groupname'];

	//establish connection
	$conn=connect();
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	$number = rand();
	$sql = array(
	'INSERT INTO groups values(' . $number . ', \'' . $_SESSION["user"] . '\',
	\'' . $groupName . '\', to_char(sysdate, \'DD-MON-YYYY\'))',
	'INSERT INTO group_lists values(' . $number . ', \'' . $_SESSION["user"] . '\',
	to_char(sysdate, \'DD-MON-YYYY\'), null)');

	for ($count = 0 ; $count < 1 ; $count++){
		//Iterate all sql statements
		//Prepare sql using conn and returns the statement identifier
		$stid = oci_parse($conn, $sql[$count]);
		//Execute a statement returned from oci_parse()
		$res=oci_execute($stid);

		if (!$res) {
			//Error Message
			$message = "Server busy";
			echo "<script type='text/javascript'>";
			echo "alert('$message');";
			echo "</script>";
		}
	}

	// Free the statement identifier when closing the connection
	oci_free_statement($stid);
	oci_close($conn);
	
	return;
}

function loadGroup(){
	//This function loads all the information for a specific group so that the owner may edit it.
	//TODO: READ AND ECHO EDITABLE TEXTBOXES
}

function saveGroup(){
	//This function saves the group back to the table with the updated statistics
	//TODO: READ TEXTBOXES AND UPDATE TABLE
}


?>
