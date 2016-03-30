<html>
    <body>
       <?php
        session_start();
	$user = $_SESSION['user-name'];	
	include("PHPconnectionDB.php");

        if (isset ($_POST['SubmitR'])){
            //get the input
            $image=$_POST['imagePath'];
            $subject=$_POST['subject'];
            $place=$_POST['place'];
            $date=$_POST['date'];
            $email=$_POST['description'];
            $access=$_POST['access'];

		echo "$user";
            
			
	    ini_set('display_errors', 1);
	    error_reporting(E_ALL);
	    
            //establish connection
            $conn=connect();
	    if (!$conn) {
    		$e = oci_error();
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    }
 	
            //sql command
            $sql = 'INSERT INTO images VALUES (
           	 \'1\', \'admin\' , \'0\', 
	    	\''.$subject.'\', \''.$place.'\', 
            	to_char(\''.$date.'\', \'DD-MON-YYYY\'),
		\''.$description.'\' , empty_blob(), empty_blob() RETURNING thumbnail, photo INTO :thumbnail, :photo)';

	    
	    //Prepare sql using conn and returns the statement identifier
	    $stid = oci_parse($conn, $sql);

		$thumbnail_blob = oci_new_descriptor($conn, OCI_D_LOB);
                $photo_blob = oci_new_descriptor($conn, OCI_D_LOB);

		oci_bind_by_name($stid, ':thumbnail', $thumbnail_blob, -1, OCI_B_BLOB);
                oci_bind_by_name($stid, ':photo', $photo_blob, -1, OCI_B_BLOB);

	    
	    //Execute a statement returned from oci_parse()
	    $res=oci_execute($stid, OCI_NO_AUTO_COMMIT);

             if(!$thumbnail_blob->save($thumbnail) || !$photo_blob->save($image)) {
                    oci_rollback($conn);
                }
                else {
                    oci_commit($conn);
                }
	
	if ($res) {
		//$err = oci_error($stid); 
		//echo htmlentities($err['message']);	
		$message = "File Uploaded";
		echo "<script type='text/javascript'>";
		echo "alert('$message');";
		echo "window.location.href = \"../upload.php\";";
		echo "</script>";
	} else {
		$message = "File Error";
		echo "<script type='text/javascript'>";
		echo "alert('$message');";
		echo "window.location.href = \"../upload.php\";";
		echo "</script>";
	}

$photo_blob->free();
                $thumbnail_blob->free();

	    
	    // Free the statement identifier when closing the connection
	    oci_free_statement($stid);
	    oci_close($conn);
    
	}
	?>
    </body>
</html>
