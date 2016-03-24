<?php
include("PHPconnectionDB.php");
?>
<html>
    <body>
       <?php
        
        if (isset ($_POST['SubmitR'])){
            //get the input
            $image=$_POST['imagePath'];
            $subject=$_POST['subject'];
            $place=$_POST['place'];
            $date=$_POST['date'];
            $email=$_POST['description'];
            $access=$_POST['access'];
            
			
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
            \''.$user.'\',\''.$pass.'\', 
            to_char(\''.$date.'\', \'DD-MON-YYYY\'))';
	    
	    //Prepare sql using conn and returns the statement identifier
	    $stid = oci_parse($conn, $sql);
	    
	    //Execute a statement returned from oci_parse()
	    $res=oci_execute($stid);

	    
	    //if error, retrieve the error using the oci_error() function & output an error message

	    if (!$res) {
	    	//Dev Error messages
		//$err = oci_error($stid); 
		//echo htmlentities($err['message']);
		$message = "Username already taken.";
		echo "<script type='text/javascript'>";
		echo "alert('$message');";
		echo "window.location.href = \"../login.html\";";
		echo "</script>";
	    }
	    
	    //Prepare sql using conn and returns the statement identifier
	    $stid = oci_parse($conn, $sql2);
	    
	    //Execute a statement returned from oci_parse()
	    $res=oci_execute($stid);
	    
	    if (!$res) {
		//Dev Error messages
		//$err = oci_error($stid); 
		//echo htmlentities($err['message']);
		$message = "Email already registered.";
		echo "<script type='text/javascript'>";
		echo "alert('$message');";
		echo "window.location.href = \"../login.html\";";
		echo "</script>";
	    }else{
		header("Location: ../home.html");
	    }
	    
	    // Free the statement identifier when closing the connection
	    oci_free_statement($stid);
	    oci_close($conn);
    
	}
	?>
    </body>
</html>
