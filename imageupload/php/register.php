<?php
include("PHPconnectionDB.php");
?>
<html>
    <body>
       <?php
        
        if (isset ($_POST['SubmitR'])){
            //get the input
            $user=$_POST['Username'];
            $pass=$_POST['Password'];
            $fname=$_POST['FName'];
            $lname=$_POST['LName'];
            $address=$_POST['Address'];
            $email=$_POST['Email'];
            $phone=$_POST['Phone'];
			
	    ini_set('display_errors', 1);
	    error_reporting(E_ALL);
	    
            //establish connection
            $conn=connect();
	    if (!$conn) {
    		$e = oci_error();
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    }
 	
        //sql command
        $sql = array(
        'INSERT INTO users VALUES (\''.$user.'\',\''.$pass.'\', to_char(sysdate, \'DD-MON-YYYY\'))',
        'INSERT INTO persons VALUES (\''.$user.'\', \''.$fname.'\', 
	    	\''.$lname.'\', \''.$address.'\', \''.$email.'\', \''.$phone.'\')',
	    'INSERT INTO group_lists VALUES(1, \''.$user.'\', to_char(sysdate, \'DD-MON-YYYY\'), null)'
        ); 
            	

	    for($count = 0; $count< 3; $count++){
			//Prepare sql using conn and returns the statement identifier
			$stid = oci_parse($conn, $sql[$count]);
			
			//Execute a statement returned from oci_parse()
			$res=oci_execute($stid, OCI_DEFAULT);
			
			if (!$res) {
				oci_rollback($conn);
				oci_free_statement($stid);
			    oci_close($conn);
				$message = "Username or Email already registered.";
				echo "<script type='text/javascript'>";
				echo "alert('$message');";
				echo "window.location.href = \"../login.html\";";
				echo "</script>";
				return;
			}else{
				
			}
	    }
	    
	    // Free the statement identifier when closing the connection
	    
	    oci_commit($conn);
	    oci_free_statement($stid);
	    oci_close($conn);
	    
	    $message = "Registration Successful.";
		echo "<script type='text/javascript'>";
		echo "alert('$message');";
		echo "window.location.href = \"../login.html\";";
		echo "</script>";
    
	}
	?>
    </body>
</html>
