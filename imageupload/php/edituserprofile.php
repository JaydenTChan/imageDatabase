<?php
include("PHPconnectionDB.php");
?>
<html>
    <body>
       <?php
       		session_start();
        
        //if (isset ($_POST['Submit'])){
            //get the input
            $cpassword=$_POST['password'];
            $cfirstname=$_POST['firstname'];
            $clastname=$_POST['lastname'];
            $caddress=$_POST['address'];
            $cemail=$_POST['email'];
            $cphone=$_POST['phone'];
			
	    ini_set('display_errors', 1);
	    error_reporting(E_ALL);
	    
	    $user=$_SESSION['user'];
	    
            //establish connection
            $conn=connect();
	    if (!$conn) {
    		$e = oci_error();
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    }
 	
            //sql command
            //$sql = 'INSERT INTO users VALUES (\''.$user.'\',\''.$pass.'\', to_char(sysdate, \'DD-MON-YYYY\'))'; 
            	
	    //$sql2 = 'INSERT INTO persons VALUES (\''.$user.'\', \''.$fname.'\', 
	    //	\''.$lname.'\', \''.$address.'\', \''.$email.'\', \''.$phone.'\')'; 
	    
	    $sql='select * from persons where user_name=\''.$user.'\'';
	    
	    //Prepare sql using conn and returns the statement identifier
	    $stid = oci_parse($conn, $sql);
	    
	    //Execute a statement returned from oci_parse()
	    $res=oci_execute($stid);
	    
	    while ($row=oci_fetch_array($stid,OCI_BOTH)){
	    	//echo "good";
	    	$username= $row[0]; 
	    	$firstname=$row[1];
	    	$lastname=$row[2];
	    	$address=$row[3];
	    	$email=$row[4];
	    	$phone=$row[5];
	    }
	    
	    
	    $sql2='select * from users where user_name=\''.$user.'\'';
	    
	     //Prepare sql using conn and returns the statement identifier
	    $stid1 = oci_parse($conn, $sql2);
	    
	    //Execute a statement returned from oci_parse()
	    $res1=oci_execute($stid1);
	    
	    while ($row=oci_fetch_array($stid,OCI_BOTH)){
	    	//echo "good";
	    	$password=$row[1];
	    }
	    
	    echo "hello --"  .$username."<br>";
	    echo "bye -" .$cpassword. "<br>";
	    echo "bye -" .$cfirstname. "<br>";
	    echo "bye -" .$clastname. "<br>";
	    echo "bye -" .$caddress. "<br>";
	    echo "bye -" .$cemail. "<br>";
	    echo "bye -" .$cphone. "<br>";
		
		//update persons set address='test update address' where user_name='TestU';
	    //$updatesql = 'Update users set (password=\'' .$password. '\') where (user_name=\'' .$username . '\')';
	    //$updatesql = 'UPDATE persons SET (address=\'' .$caddress. '\') WHERE (user_name=\'' .$username. '\')';
	    $updatesql = 'UPDATE persons SET first_name=:firstname, last_name=:lastname, address=:address, email=:email, phone=:phone WHERE user_name=:username';
	    
	    $updatesql1 = 'UPDATE users SET password=:password WHERE user_name=:username';
	    
	    
	    $updatestid1 = oci_parse($conn, $updatesql1);
	
		oci_bind_by_name($updatestid1, ':username', $username);
		oci_bind_by_name($updatestid1, ':password', $cpassword);
	     
	    $updateres1=oci_execute($updatestid1, OCI_DEFAULT);

	     if (!$updateres1) {
		//Dev Error messages
		//$err = oci_error($stid); 6
		//echo htmlentities($err['message']);
		$message = "Some Error.";
		echo "<script type='text/javascript'>";
		echo "alert('$message');";
		echo "window.location.href = \"../user.php\";";
		echo "</script>";
	    } /*else {
	    	oci_commit($conn);
	    	$message = "Profile Updated.";
			echo "<script type='text/javascript'>";
			echo "alert('$message');";
			echo "window.location.href = \"../user.php\";";
			echo "</script>";
			//header("Location: ../home.php");
	    }*/
	    
	    $updatestid = oci_parse($conn, $updatesql);	    
	    
	    oci_bind_by_name($updatestid, ':firstname', $cfirstname);
	    oci_bind_by_name($updatestid, ':lastname', $clastname);
	    oci_bind_by_name($updatestid, ':address', $caddress);
	    oci_bind_by_name($updatestid, ':email', $cemail);
	    oci_bind_by_name($updatestid, ':phone', $cphone);
	    oci_bind_by_name($updatestid, ':username', $username);

	    //Execute a statement returned from oci_parse()
	    $updateres=oci_execute($updatestid, OCI_DEFAULT);
	    
	    //if error, retrieve the error using the oci_error() function & output an error message
	    if (!$updateres) {
		//Dev Error messages
		//$err = oci_error($stid); 6
		//echo htmlentities($err['message']);
		$message = "Email aleady exist.";
		echo "<script type='text/javascript'>";
		echo "alert('$message');";
		echo "window.location.href = \"../user.php\";";
		echo "</script>";
	    } else {
	    	oci_commit($conn);
	    	$message = "Profile Updated.";
		echo "<script type='text/javascript'>";
		echo "alert('$message');";
		echo "window.location.href = \"../user.php\";";
		echo "</script>";
			//header("Location: ../home.php");
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
