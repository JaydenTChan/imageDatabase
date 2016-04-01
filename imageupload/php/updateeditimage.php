<?php
include("PHPconnectionDB.php");
?>
<html>
    <body>
       <?php
       		session_start();

        $csubject=$_POST['subject'];
        $cplace=$_POST['place'];
        $cdate=$_POST['date'];
        $cdescription=$_POST['description'];
        $caccess=$_POST['access'];
 
	    ini_set('display_errors', 1);
	    error_reporting(E_ALL);
	    
	    $user=$_SESSION['user'];
	    $photo_id = $_GET['id'];
	    
        //establish connection
    	$conn=connect();
	    if (!$conn) {
    		$e = oci_error();
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    }
	    
	    if ($_SESSION["user"] == 'admin'){
			$updatesql = 
			"UPDATE images SET 
			subject='" .$csubject. "', 
			place='" .$cplace. "', 
			timing=to_date('" .$cdate. "','DD-MM-YYYY'), 
			description='" .$cdescription. "' where photo_id='" .$photo_id. "'";
	    }else{
			$updatesql = 
			"UPDATE images SET 
			subject='" .$csubject. "', 
			place='" .$cplace. "', 
			timing=to_date('" .$cdate. "','DD-MM-YYYY'), 
			description='" .$cdescription. "' where photo_id='" .$photo_id. "' AND owner_name='" .$_SESSION['user']. "'";
	    }
	    
	    $updatestid = oci_parse($conn, $updatesql);	    

	    //Execute a statement returned from oci_parse()
	    $updateres=oci_execute($updatestid, OCI_DEFAULT);
	    
	    //if error, retrieve the error using the oci_error() function & output an error message
	    if (!$updateres) {
			$message = "You don't own the image!";
			echo "<script type='text/javascript'>";
			echo "alert('$message');";
			echo "window.location.href = \"../viewimage.php?id=$photo_id&type=photo\";";
			echo "</script>";
	    } else {
	    	oci_commit($conn);
	    	$message = "Image Updated.";
			echo "<script type='text/javascript'>";
			echo "alert('$message');";
			echo "window.location.href = \"../viewimage.php?id=$photo_id&type=photo\";";
			echo "</script>";
	    }
	    
	    // Free the statement identifier when closing the connection
	    oci_free_statement($stid);
	    oci_free_statement($stid1);
	    oci_free_statement($updatestid);
	    oci_free_statement($updatestid1);
	    oci_close($conn);
    
	//}
	?>
    </body>
</html>
