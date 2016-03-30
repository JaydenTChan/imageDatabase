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
            $sql = 'INSERT INTO users VALUES (\''.$user.'\',\''.$pass.'\', to_char(sysdate, \'DD-MON-YYYY\'))'; 
            	
	    	$sql2 = 'INSERT INTO persons VALUES (\''.$user.'\', \''.$fname.'\', 
	    	\''.$lname.'\', \''.$address.'\', \''.$email.'\', \''.$phone.'\')'; 
	    
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
