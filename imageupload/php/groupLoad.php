<?php
include("PHPconnectionDB.php");

function getUserGroups(){
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
		
		//if($row ==true){echo "<option value=default>Hello</option>";}else{echo "<option value=default>Fail</option>";}
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
	session_start();

	//establish connection
	$conn=connect();
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	$number = rand();
	$sql = 'INSERT INTO groups values(' . $number . ', \'admin\',\'cool\', to_char(sysdate, \'DD-MON-YYYY\'))';

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
	}

	// Free the statement identifier when closing the connection
	oci_free_statement($stid);
	oci_close($conn);
	
	return;
}

?>
