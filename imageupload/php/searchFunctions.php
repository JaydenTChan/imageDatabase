<?php
/*
Created by JaydenTChan 2016-03-31
A lot of the code is referenced from the SQL examples as provided by eclass
*/

session_start();
include("PHPconnectionDB.php");
include("index.php");

function search($k_words, $fr_date, $to_date, $sort){
	if (isset ($_POST['Search'])){
	    indexImages();

	    ini_set('display_errors', 1);
	    error_reporting(E_ALL);
	    
	    //establish connection
	    $conn=connect();
	    if (!$conn) {
    		$e = oci_error();
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    }
	    
	    //Add ands
	    $k_words = str_replace(' ', ' AND ', $k_words);
 	
	    //sql command
	    
	    $sql = array(
	    '
	    SELECT photo_id FROM images 
	    WHERE CONTAINS(subject, \'' . $k_words . '\', 1) > 0 
	    OR CONTAINS(place, \'' . $k_words . '\', 2) > 0
	    OR CONTAINS(description, \'' . $k_words . '\', 3) > 0
	    ORDER BY timing ASC',
	    '
	    SELECT photo_id FROM images 
	    WHERE CONTAINS(subject, \'' . $k_words . '\', 1) > 0 
	    OR CONTAINS(place, \'' . $k_words . '\', 2) > 0
	    OR CONTAINS(description, \'' . $k_words . '\', 3) > 0
	    ORDER BY timing DESC',
	    '
	    SELECT photo_id FROM images 
	    WHERE CONTAINS(subject, \'' . $k_words . '\', 1) > 0 
	    OR CONTAINS(place, \'' . $k_words . '\', 2) > 0
	    OR CONTAINS(description, \'' . $k_words . '\', 3) > 0
	    ORDER BY (6*score(1) + 3*score(2) + score(3)) DESC'
	    );
	    
	    //
	    
	    //Prepare sql using conn and returns the statement identifier
	    if($sort == 'New'){
	    	$stid = oci_parse($conn, $sql[0]);
    	    }else if($sort == 'Old'){
    	    	$stid = oci_parse($conn, $sql[1]);
    	    }else{
    	    	$stid = oci_parse($conn, $sql[2]);
    	    }
	    
	    //Execute a statement returned from oci_parse()
	    $res=oci_execute($stid);

	    
	    //if error, retrieve the error using the oci_error() function & output an error message

	    if (!$res) {
		$err = oci_error($stid); 
		echo htmlentities($err['message']);

	    }
	    else{
			$row = oci_fetch_row($stid);
			if ($row == true){
				$_SESSION["user"]=$row[0];//Save the user name
				header("Location: getSession.php");
			}else {
			//Source: http://stackoverflow.com/questions/13851528/how-to-pop-an-alert-message-box-using-php
			//Source: http://stackoverflow.com/questions/19825283/redirect-to-a-page-url-after-alert-button-is-pressed
				$message = "Incorrect username/password";
				echo "<script type='text/javascript'>";
				echo "alert('$message');";
				echo "window.location.href = \"../login.html\";";
				echo "</script>";
	
			}

	    }
	    
	    // Free the statement identifier when closing the connection
	    oci_free_statement($stid);
	    oci_close($conn);
    
	}
}


?>
