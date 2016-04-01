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
 	
            //sql command
            //$sql = 'INSERT INTO users VALUES (\''.$user.'\',\''.$pass.'\', to_char(sysdate, \'DD-MON-YYYY\'))'; 
            	
	    //$sql2 = 'INSERT INTO persons VALUES (\''.$user.'\', \''.$fname.'\', 
	    //	\''.$lname.'\', \''.$address.'\', \''.$email.'\', \''.$phone.'\')'; 
	    
	    /*$sql='select * from images where owner_name=\''.$user.'\' AND photo_id=\''.$photo_id.'\'';
	    
	    //Prepare sql using conn and returns the statement identifier
	    $stid = oci_parse($conn, $sql);
	    
	    //Execute a statement returned from oci_parse()
	    $res=oci_execute($stid);
	    
	    while ($row=oci_fetch_array($stid,OCI_BOTH)){
	    	//echo "good";
	    	$photo_id= $row[0]; 
	    	$owner_name=$row[1];
	    	$permitted=$row[2];
	    	$subject=$row[3];
	    	$place=$row[4];
	    	$date=$row[5];
	    	$description=$row[6];
	    	$thumbnail=$row[7];
	    	$photo=$row[8];
	    }

	    echo "<br>";
	    echo "hello --"  .$user."<br>";
	    echo "hello --"  .$photo_id."<br>";
	    echo "bye -" .$csubject. "<br>";
	    echo "bye -" .$cplace. "<br>";
	    echo "bye -" .$cdate. "<br>";
	    echo "bye -" .$cdescription. "<br>";
	    echo "bye -" .$caccess. "<br>";*/
		
		//update persons set address='test update address' where user_name='TestU';
	    //$updatesql = 'Update users set (password=\'' .$password. '\') where (user_name=\'' .$username . '\')';
	    //$updatesql = 'UPDATE persons SET (address=\'' .$caddress. '\') WHERE (user_name=\'' .$username. '\')';
	    //$updatesql = 'UPDATE images SET subject=:subject, place=:place, timing=to_date(:date,\'DD-MM-YYYY\'), description=:description where photo_id=:photo_id AND owner_name=:user';
	    
	    echo "<br>";
	    echo "Hello --"  .$user."<br>";
	    echo "ID --"  .$photo_id."<br>";
	    
	    $updatesql = 
	    "DELETE from images WHERE 
		photo_id='" .$photo_id. "'";
	    
	    
	    $updatestid = oci_parse($conn, $updatesql);	    
/*	    
	    //oci_bind_by_name($updatestid, ':permitted', $cpermitted);
	    oci_bind_by_name($updatestid, ':user', $user);
	    oci_bind_by_name($updatestid, ':photo_id', $photo_id);
	    oci_bind_by_name($updatestid, ':subject', $csubject);
	    oci_bind_by_name($updatestid, ':place', $cplace);
	    oci_bind_by_name($updatestid, ':date', $cdate);
	    oci_bind_by_name($updatestid, ':description', $cdescription);
*/
	    //Execute a statement returned from oci_parse()
	    $updateres=oci_execute($updatestid, OCI_DEFAULT);
	    
	    //if error, retrieve the error using the oci_error() function & output an error message
	    if (!$updateres) {
		//Dev Error messages
		//$err = oci_error($stid); 6
		//echo htmlentities($err['message']);
		$message = "Some Error.";
		echo "<script type='text/javascript'>";
		echo "alert('$message');";
		echo "window.location.href = \"../user.php\";";
		echo "</script>";
	    } else {
	    	oci_commit($conn);
	    	$message = "Image Deleted.";
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
