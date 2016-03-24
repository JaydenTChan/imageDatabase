<?php
include("PHPconnectionDB.php");
?>
<html>
    <body>
       <?php
        
        if (isset ($_POST['Submit'])){
            //get the input
            $name=$_POST['Username'];
            $pass=$_POST['Password'];
			
	    ini_set('display_errors', 1);
	    error_reporting(E_ALL);
	    
            //establish connection
            $conn=connect();
	    if (!$conn) {
    		$e = oci_error();
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    }
 	
            //sql command
            $sql = 'SELECT * FROM users WHERE user_name = \''.$name.'\' and password = \''.$pass.'\'' ;
            //
	    
	    //Prepare sql using conn and returns the statement identifier
	    $stid = oci_parse($conn, $sql);
	    
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
				header("Location: ../home.html");
			}
			else {
				echo $name;
			}
		
	    }
	    
	    // Free the statement identifier when closing the connection
	    oci_free_statement($stid);
	    oci_close($conn);
    
	}
	?>
    </body>
</html>
