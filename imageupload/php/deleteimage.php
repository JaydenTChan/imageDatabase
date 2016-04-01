<?php
include("PHPconnectionDB.php");
?>
<html>
    <body>
       <?php
   		session_start();
        
        //if (isset ($_POST['Submit'])){
        //get the input
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
	    
	    if($_SESSION["user"]=='admin'){
			$updatesql =array("
			DELETE from image_views WHERE photo_id='" .$photo_id. "'
			",
			"DELETE from images WHERE 
			photo_id='" .$photo_id. "'");
		}else{
			$updatesql = array("
			DELETE from image_views 
			WHERE
			(SELECT photo_id
				FROM images i, image_view iv
				WHERE i.photo_id = iv._photoid AND
				owner_name = '" . $user . "') =
				photo_id
			",
			"DELETE from images 
			WHERE 
			photo_id='" .$photo_id. "' AND
			owner_name = '" . $user . "'");
		}
	    
	    $updatestid = oci_parse($conn, $updatesql[0]);	    

	    //Execute a statement returned from oci_parse()
	    $res=oci_execute($updatestid);
	    
	    //if error, retrieve the error using the oci_error() function & output an error message
	    if (!$res) {
			$message = "You don't own the image!";
			echo "<script type='text/javascript'>";
			echo "alert('$message');";
			echo "window.location.href = \"../user.php\";";
			echo "</script>";
	    } else {
	    	$message = "Image Deleted.";
			echo "<script type='text/javascript'>";
			echo "alert('$message');";
			echo "window.location.href = \"../user.php\";";
			echo "</script>";
	    }
	    
	    $updatestid = oci_parse($conn, $updatesql[1]);	    

	    //Execute a statement returned from oci_parse()
	    $res=oci_execute($updatestid);
	    
	    //if error, retrieve the error using the oci_error() function & output an error message
	    if (!$res) {
			$message = "You don't own the image!";
			echo "<script type='text/javascript'>";
			echo "alert('$message');";
			echo "window.location.href = \"../user.php\";";
			echo "</script>";
	    } else {
	    	$message = "Image Deleted.";
			echo "<script type='text/javascript'>";
			echo "alert('$message');";
			echo "window.location.href = \"../user.php\";";
			echo "</script>";
	    }
	    
	    // Free the statement identifier when closing the connection
	    oci_free_statement($updatestid);
	    oci_close($conn);
    
	//}
	?>
    </body>
</html>
