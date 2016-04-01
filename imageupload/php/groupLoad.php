<?php
/*
Created by JaydenTChan 2016-03-30
A lot of the code is referenced from the SQL examples as provided by eclass
*/

session_start();
include("PHPconnectionDB.php");

function getUserOwnerGroups(){
	//This function gets all the groups the user owns

	//establish connection
	$conn=connect();
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	if($_SESSION["user"] == "admin"){
		//If admin get all groups
		$sql = 'SELECT * FROM groups';
	}else{
		$sql = 'SELECT * FROM groups WHERE user_name = \'' . $_SESSION["user"] . '\'';
	}
	

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

	//establish connection
	$conn=connect();
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	
	//Get the groups where the owner is part of a group
	$sql = '
	SELECT group_lists.group_id, group_name FROM group_lists, groups 
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
		echo "</script>";
	}else{
		echo "<select name=\"groupList\">";
		
		while($row = oci_fetch_row($stid)){
			//Loop until no more rows
			echo "<option value=" . $row[0] . ">" . $row[1] . "</option>";
		}
		echo "</select>";
	}

	
	// Free the statement identifier when closing the connection
	oci_free_statement($stid);
	oci_close($conn);
	
	return;
}

function createGroup($groupName){
	//This function is used to create new groups

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

	for ($count = 0 ; $count < 2 ; $count++){
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
	
	header("Refresh:0");
	
	return;
}

function loadGroup($groupID){
	//This function loads all the information for a specific group so that the owner may edit it.

	//establish connection
	$conn=connect();
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	$sql = array('
	SELECT group_name, date_created, user_name FROM groups WHERE group_id = \'' . $groupID . '\'','
	SELECT friend_id FROM group_lists WHERE group_id = \'' . $groupID . '\' 
	AND friend_id <> \'' . $_SESSION["user"] . '\''
	);

	for ($count = 0 ; $count < 2 ; $count++){
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
		//TODO: READ AND ECHO EDITABLE TEXTBOXES
		if($count == 0){
			//groups
			$row = oci_fetch_row($stid);
			echo '<form method="post">';
			echo '<P>Owner: ' .$row[2]. '</P>';
			echo '<label for="gname">Group Name: </label>';
			echo '<input id="gname" type="text" name="groupName" value="'. $row[0] .'">';
			echo '<input type="submit" value="Change" name="change">';
			echo '</form>';
			echo '<P>Date Created: ' . $row[1] . '</p>';
		}else{
			//group_lists
			echo '<label for="userList">Users: </label>';
			echo '<form id="userList" method="post">';
			echo "<select name=\"friendList\">";
		
			while($row = oci_fetch_row($stid)){
				//Loop until no more rows
				echo "<option value=\"" . $row[0] . "\">" . $row[0] . "</option>";
			}
			echo "</select>";		
			echo '<input type="submit" name="delete" value="Delete">';
			echo "</form>";
			echo "<br>";
		}
		
	}

	// Free the statement identifier when closing the connection
	oci_free_statement($stid);
	oci_close($conn);
	
	return;
}

function saveGroup($groupID, $groupName){
	//This function saves the group back to the table with the updated name
	//TODO: READ TEXTBOXES AND UPDATE TABLE
	/*SQL STATEMENT
	'
	UPDATE groups
	SET group_name = $groupName
	WHERE group_id = ' . $groupID . ''
	*/
		//establish connection
	$conn=connect();
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	$sql = '
	UPDATE groups
	SET group_name = \'' .$groupName. '\'
	WHERE group_id = ' . $groupID . '';

	//Prepare sql using conn and returns the statement identifier
	$stid = oci_parse($conn, $sql);
	//Execute a statement returned from oci_parse()
	$res=oci_execute($stid);

	if (!$res) {
		//Error Message
		$message = "Failed to save";
		echo "<script type='text/javascript'>";
		echo "alert('$message');";
		echo "</script>";
	}else{
		
	}

	
	// Free the statement identifier when closing the connection
	oci_free_statement($stid);
	oci_close($conn);
	
	header("Refresh:0");
	
	return;
}

function addFriendToGroup($groupID, $friendID){
	//This function saves the friend into group_lists
	//TODO: READ FROM LIST AND WRITE ONLY NEW FRIENDS
	/*SQL STATEMENT
	'
	INSERT INTO group_lists VALUES(' .$groupID. ', \'' .$friendID. '\',
	to_char(sysdate, \'DD-MON-YYYY\'), \'' .$notice. '\')'
	*/
	
	//establish connection
	$conn=connect();
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	$sql = '
	INSERT INTO group_lists VALUES(' .$groupID. ', \'' .$friendID. '\',
	to_char(sysdate, \'DD-MON-YYYY\'), null)';

	//Prepare sql using conn and returns the statement identifier
	$stid = oci_parse($conn, $sql);
	//Execute a statement returned from oci_parse()
	$res=oci_execute($stid);

	if (!$res) {
		//Error Message
		$message = "User already part of this group! or Does not exist!";
		echo "<script type='text/javascript'>";
		echo "alert('$message');";
		echo "</script>";
		header("Refresh:0");
	}

	// Free the statement identifier when closing the connection
	oci_free_statement($stid);
	oci_close($conn);
	
	header("Refresh:0");
	
	return;
}

function removeFriendFromGroup($groupID, $friendID){
	//This function removes the friend from group_lists
	//TODO: READ FROM LIST AND WRITE ONLY NEW FRIENDS
	/*SQL STATEMENT
	'
	DELETE FROM group_lists
	WHERE group_id = ' .$groupID. ' AND friend_id = \'' .$friendID. '\' '
	*/
	//establish connection
	$conn=connect();
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	$sql = '
	DELETE FROM group_lists
	WHERE group_id = ' .$groupID. ' AND friend_id = \'' .$friendID. '\' ';

	//Prepare sql using conn and returns the statement identifier
	$stid = oci_parse($conn, $sql);
	//Execute a statement returned from oci_parse()
	$res=oci_execute($stid);

	if (!$res) {
		//Error Message
		$message = "Failed to delete";
		echo "<script type='text/javascript'>";
		echo "alert('$message');";
		echo "window.location.href = \"../login.html\";";
		echo "</script>";
	}else{
		
	}

	
	// Free the statement identifier when closing the connection
	oci_free_statement($stid);
	oci_close($conn);
	
	header("Refresh:0");
	
	return;
}

function deleteGroup($groupID){
	//This Function deletes the group from the SQL database
	//It will also delete all attached files from the group
	/*SQL STATEMENT
	'
	DELETE FROM group_lists
	WHERE group_id = ' .$groupID. ''
	AND
	'
	DELETE FROM groups
	WHERE group_id = ' .$groupID. ''
	*/
	//establish connection
	$conn=connect();
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	$sql = array(
	'
	DELETE FROM group_lists
	WHERE group_id = ' .$groupID. '',
	'
	DELETE FROM groups
	WHERE group_id = ' .$groupID. '',
	'
	DELETE FROM images
	WHERE permitted = ' .$groupID. '
	');

	for ($count = 0 ; $count < 3 ; $count++){
		//Iterate all sql statements
		//Prepare sql using conn and returns the statement identifier
		$stid = oci_parse($conn, $sql[$count]);
		//Execute a statement returned from oci_parse()
		$res=oci_execute($stid);

		if (!$res) {
			//Error Message
			$message = "Something Went Wrong";
			echo "<script type='text/javascript'>";
			echo "alert('$message');";
			echo "</script>";
		}
	}

	// Free the statement identifier when closing the connection
	oci_free_statement($stid);
	oci_close($conn);
	
	header("Refresh:0");
	
	return;
	
}


?>
