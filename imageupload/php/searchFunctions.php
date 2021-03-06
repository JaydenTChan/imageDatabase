<?php
/*
Created by JaydenTChan 2016-03-31
A lot of the code is referenced from the SQL examples as provided by eclass
*/

session_start();
include("PHPconnectionDB.php");
include("index.php");

function search($k_words, $fr_date, $to_date, $sort){
	
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	
	if ($fr_date == ""){
		$fr_date = "01/01/1000";
	}
	if ($to_date == ""){
		$to_date = "01/01/4000";
	}

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
	"
	SELECT UNIQUE photo_id, timing
	FROM images, group_lists
	WHERE 
	(CONTAINS(subject, '".$k_words."', 1) > 0 
	OR CONTAINS(place, '".$k_words."', 2) > 0
	OR CONTAINS(description, '".$k_words."', 3) > 0)
	AND (
	('".$_SESSION["user"]."' = friend_id AND group_id = permitted)
	OR ('".$_SESSION["user"]."' = owner_name)) AND
	timing >= TO_DATE('".$fr_date."', 'DD-MM-YYYY') AND
	timing <= TO_DATE('".$to_date."', 'DD-MM-YYYY')
	ORDER BY timing ASC",
	"
	SELECT UNIQUE photo_id, timing
	FROM images, group_lists
	WHERE 
	(CONTAINS(subject, '".$k_words."', 1) > 0 
	OR CONTAINS(place, '".$k_words."', 2) > 0
	OR CONTAINS(description, '".$k_words."', 3) > 0)
	AND (
	('".$_SESSION["user"]."' = friend_id AND group_id = permitted)
	OR 
	('".$_SESSION["user"]."' = owner_name)) AND
	timing >= TO_DATE('".$fr_date."', 'DD-MM-YYYY') AND
	timing <= TO_DATE('".$to_date."', 'DD-MM-YYYY')
	ORDER BY timing DESC",
	"
	SELECT UNIQUE photo_id, (6*score(1) + 3*score(2) + score(3))
	FROM images, group_lists
	WHERE 
	(CONTAINS(subject, '".$k_words."', 1) > 0 
	OR CONTAINS(place, '".$k_words."', 2) > 0
	OR CONTAINS(description, '".$k_words."', 3) > 0)
	AND (
	('".$_SESSION["user"]."' = friend_id AND group_id = permitted)
	OR ('".$_SESSION["user"]."' = owner_name)) AND
	timing >= TO_DATE('".$fr_date."', 'DD-MM-YYYY') AND
	timing <= TO_DATE('".$to_date."', 'DD-MM-YYYY')
	ORDER BY (6*score(1) + 3*score(2) + score(3)) DESC",
	"
	SELECT UNIQUE photo_id FROM images, group_lists
	WHERE
	(('" .$_SESSION["user"]. "' = friend_id AND group_id = permitted)
	OR ('" .$_SESSION["user"]. "' = owner_name)) AND
	timing >= TO_DATE('" . $fr_date . "', 'DD-MM-YYYY') AND
	timing <= TO_DATE('" . $to_date . "', 'DD-MM-YYYY')
	",
	"
	SELECT UNIQUE photo_id, timing FROM images, group_lists
	WHERE(
	('".$_SESSION["user"]."' = friend_id AND group_id = permitted)
	OR ('".$_SESSION["user"]."' = owner_name)) AND
	timing >= TO_DATE('" . $fr_date . "', 'DD-MM-YYYY') AND
	timing <= TO_DATE('" . $to_date . "', 'DD-MM-YYYY')
	ORDER BY timing ASC
	",
	"
	SELECT UNIQUE photo_id, timing FROM images, group_lists
	WHERE(
	('".$_SESSION["user"]."' = friend_id AND group_id = permitted)
	OR ('".$_SESSION["user"]."' = owner_name)) AND
	timing >= TO_DATE('" . $fr_date . "', 'DD-MM-YYYY') AND
	timing <= TO_DATE('" . $to_date . "', 'DD-MM-YYYY')
	ORDER BY timing DESC
	",
	"
	SELECT UNIQUE photo_id FROM images, group_lists
	WHERE
	(CONTAINS(subject, '".$k_words."', 1) > 0 
	OR CONTAINS(place, '".$k_words."', 2) > 0
	OR CONTAINS(description, '".$k_words."', 3) > 0) AND
	timing >= TO_DATE('" . $fr_date . "', 'DD-MM-YYYY') AND
	timing <= TO_DATE('" . $to_date . "', 'DD-MM-YYYY')
	",
	"
	SELECT UNIQUE photo_id, timing FROM images, group_lists
	WHERE
	(CONTAINS(subject, '".$k_words."', 1) > 0 
	OR CONTAINS(place, '".$k_words."', 2) > 0
	OR CONTAINS(description, '".$k_words."', 3) > 0) AND
	timing >= TO_DATE('" . $fr_date . "', 'DD-MM-YYYY') AND
	timing <= TO_DATE('" . $to_date . "', 'DD-MM-YYYY')
	ORDER BY timing ASC
	",
	"
	SELECT UNIQUE photo_id, timing FROM images, group_lists
	WHERE
	(CONTAINS(subject, '".$k_words."', 1) > 0 
	OR CONTAINS(place, '".$k_words."', 2) > 0
	OR CONTAINS(description, '".$k_words."', 3) > 0) AND
	timing >= TO_DATE('" . $fr_date . "', 'DD-MM-YYYY') AND
	timing <= TO_DATE('" . $to_date . "', 'DD-MM-YYYY')
	ORDER BY timing DESC
	",
	"
	SELECT UNIQUE photo_id FROM images, group_lists
	WHERE
	timing >= TO_DATE('" . $fr_date . "', 'DD-MM-YYYY') AND
	timing <= TO_DATE('" . $to_date . "', 'DD-MM-YYYY')
	",
	"
	SELECT UNIQUE photo_id, timing FROM images, group_lists
	WHERE
	timing >= TO_DATE('" . $fr_date . "', 'DD-MM-YYYY') AND
	timing <= TO_DATE('" . $to_date . "', 'DD-MM-YYYY')
	ORDER BY timing ASC
	",
	"
	SELECT UNIQUE photo_id, timing FROM images, group_lists
	WHERE
	timing >= TO_DATE('" . $fr_date . "', 'DD-MM-YYYY') AND
	timing <= TO_DATE('" . $to_date . "', 'DD-MM-YYYY')
	ORDER BY timing DESC
	"
	
	
	);

	//

	//Prepare sql using conn and returns the statement identifier
	if ($_SESSION["user"] == 'admin'){
	//Admin statements
		if ($k_words==""){
			//Get all images!
			$stid = oci_parse($conn, $sql[9]);
			if($sort == 'New'){
				$stid = oci_parse($conn, $sql[10]);
			}else if($sort == 'Old'){
				$stid = oci_parse($conn, $sql[11]);
			}
		}else{
			if($sort == 'New'){
				$stid = oci_parse($conn, $sql[6]);
			}else if($sort == 'Old'){
				$stid = oci_parse($conn, $sql[7]);
			}else{
				$stid = oci_parse($conn, $sql[8]);
			}
		}	
	
	}else{
		if ($k_words==""){
			//Get all images!
			$stid = oci_parse($conn, $sql[3]);
			if($sort == 'New'){
				$stid = oci_parse($conn, $sql[4]);
			}else if($sort == 'Old'){
				$stid = oci_parse($conn, $sql[5]);
			}
		}else{
			if($sort == 'New'){
				$stid = oci_parse($conn, $sql[0]);
			}else if($sort == 'Old'){
				$stid = oci_parse($conn, $sql[1]);
			}else{
				$stid = oci_parse($conn, $sql[2]);
			}
		}
	}

	//Execute a statement returned from oci_parse()
	$res=oci_execute($stid);


	//if error, retrieve the error using the oci_error() function & output an error message
	$gotOne = 0;
	
	if (!$res) {
		$err = oci_error($stid); 
		echo htmlentities($err['message']);
	}else{
		while($row = oci_fetch_row($stid)){
			//Loop through all results
				$gotOne = 1;
				echo '<a href="viewimage.php?id='.$row[0].'&type=photo"><img src ="php/getFullImage.php?id='.$row[0].'&type=photo" width="200px" length="200px" height="200px"/> </a>';
		}
	}
	
	if($gotOne == 0){
		echo "No results found";
	}
	
	// Free the statement identifier when closing the connection
	oci_free_statement($stid);
	oci_close($conn);	
}


?>
