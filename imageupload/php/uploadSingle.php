<?php
session_start();
?>
<html>
    <body>
    <?php
    	include("PHPconnectionDB.php");
		include("resizeimage.php");
		include("index.php");
		$user = $_SESSION['user'];

	//http://stackoverflow.com/questions/24895170/multiple-image-upload-php-form-with-one-input
    	//print_r($_FILES);
	//http://php.net/manual/en/function.oci-connect.
	//Format from r-hu1 github
    
	$conn = connect(); 
	if (!$conn) {
	$e = oci_error();
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
    	
	$subject = $_POST['subject'];
	$place = $_POST['place'];
	$date = $_POST['date'];
	$description = $_POST['description'];
	$permitted = $_POST['access'];
	
	if ($date == ""){
		$date = date("d/m/Y");
	}
	
	
	for($i=0; $i<count($_FILES['image']['name']); $i++) {
	
	    	if(isset($_FILES["image"])) {
			@list($w,$h , $imtype, ) = getimagesize($_FILES['image']['tmp_name'][$i]);

				// Get Image Type
			if ($imtype == 4){ // cheking image type
			    $ext="jpg";
			}
			elseif ($imtype == 3){ // cheking image type
			    $ext="png";
			}
			elseif ($imtype == 2){
			    $ext="jpeg";
			}
			elseif ($imtype == 1){
			    $ext="gif";
			}
			else{
			    $message = "File Format Unknown.";
					echo "<script type='text/javascript'>";
					echo "alert('$message');";
					echo "window.location.href = \"../upload.php\";";
					echo "</script>";
			}
		
			if(getimagesize($_FILES['image']['tmp_name'][$i]) == FALSE){
				echo "Please select an image.";
			} else {            
				$tmp_name = $_FILES['image']['tmp_name'][$i];
			  	list($width, $height) = getimagesize($tmp_name);
				$image= addslashes($_FILES['image']['tmp_name'][$i]);
				$image= file_get_contents($image);
				$thumbnail = scaleImageFileToBlob($_FILES['image']['tmp_name'][$i]);   
				$photo_id = rand();    
				echo "Subject: " .$subject. "<br>";
				echo "Place: " .$place. "<br>";
				echo "Date: " .$date. "<br>";
				echo "Description: " .$description. "<br>";
				echo "Access: " .$permitted. "<br>";
				echo "Photo_ID: " .$photo_id. "<br>";     	
	    		$blob1   = oci_new_descriptor($conn, OCI_D_LOB);
	    		$blob2  = oci_new_descriptor($conn, OCI_D_LOB);
	    		//used to save blob
	    		$sql = '
	    		INSERT INTO images
	    		(photo_id,owner_name,permitted,subject,place,timing,description,thumbnail,photo) 
	    		VALUES
	    		(:photo_id, 
	    		:owner_name, 
	    		:permitted, 
	    		:subject, 
	    		:place, 
	    		TO_DATE( :time, \'DD-MM-YYYY\'), 
	    		:notes, 
	    		EMPTY_BLOB(), EMPTY_BLOB()) 
	    		returning thumbnail, photo into :thumbnail, :photo';
	    		
	    		$stmt = oci_parse($conn, $sql);
	      
	      		oci_bind_by_name($stmt, ':owner_name', $user);
	      		oci_bind_by_name($stmt, ':permitted', $permitted);
	      		oci_bind_by_name($stmt, ':photo_id', $photo_id);
	      		oci_bind_by_name($stmt, ':subject', $subject);
	      		oci_bind_by_name($stmt, ':place', $place);
	      		oci_bind_by_name($stmt, ':time', $date);
	      		oci_bind_by_name($stmt, ':notes', $description);
	      
	      		oci_bind_by_name($stmt, ':thumbnail', $blob1, -1,  OCI_B_BLOB);
	      		oci_bind_by_name($stmt, ':photo', $blob2, -1,  OCI_B_BLOB);
		      
		      
		      	if(!oci_execute($stmt, OCI_DEFAULT)) {
					$message = "SOME ERROR.";
					echo "<script type='text/javascript'>";
					echo "alert('$message');";
					echo "window.location.href = \"../upload.php\";";
					echo "</script>";
				} else {
		 			
					/*$message = "Image Uploaded.";
					echo "<script type='text/javascript'>";
					echo "alert('$message');";
					echo "window.location.href = \"../upload.php\";";
					echo "</script>";*/
					// save the blob data
			  		$blob1->save($thumbnail);
					$blob2->save($image);
					// commit the query
					oci_commit($conn);
					// free up the blob descriptors
					$blob1->free();
					$blob2->free();
				}

		      	oci_free_statement($stmt);
			}
		}
	}	
		
	
	oci_close($conn);
	echo '<center><form method="post" action ="../upload.php"><input type="submit" name="submit" value="continue" /> </form></center>';
      
      indexImages();
     
?>
    </body>
</html>
