<?php
session_start();
?>
<html>
    <body>
    <?php
       	include("PHPconnectionDB.php");
       	//$curuser = $_SESSION["user"];
       	$username = $_SESSION['user'];
       	echo "User: " .$userna. "<br>";
       
       	$image=$_POST['imagePath'];
       	$subject=$_POST['subject'];
   		echo "Subject: " .$subject. "<br>";
   		$place=$_POST['place'];
    	echo "Place: " .$place. "<br>";
    	$date=$_POST['date'];
    	echo "Date: " .$subject. "<br>";
    	$description=$_POST['description'];
     	echo "Subject: " .$description. "<br>";
       	$access=$_POST['access'];
       	echo "Subject: " .$access. "<br>";
       	
        //if (isset ($_POST['SubmitR'])){
		$conn=connect();
	    if (!$conn) {
    		$e = oci_error();
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    }
		
		
		/*$permission = $_POST['permission'];
		if ($permission == "public") {
			$permission = 1;
		 else if($permission == "private") {
			$permission = 2;
		} else {
			$permission = $permission;
		}*/
		
		$subject = $_POST['subject'];
		$place = $_POST['place'];
		$timing = $_POST['date'];
		$time = strtotime($timing);	
		$timing = date("d/M/Y",$time);
		$description = $_POST['description'];
		foreach ($_FILES['imagePath']['tmp_name'] as $key => $tmp_name) {
    		$photo_id = mt_rand();
    		$file_name = $key.$_FILES['imagePath']['name'][$key];
    		$file_size =$_FILES['imagePath']['size'][$key];
    		$file_tmp =$_FILES['imagePath']['tmp_name'][$key];
    		$file_type=$_FILES['imagePath']['type'][$key];
		
    		$extensions = array("jpeg","jpg","gif");
    		$file_ext=explode('.',$_FILES['imagePath']['name'][$key])	;
    		$file_ext=end($file_ext);  
    		$file_ext=strtolower(end(explode('.',$_FILES['imagePath']['name'][$key])));  
    		if(in_array($file_ext,$extensions ) === false){
    			$errors[]="extension not allowed";
    		}
    		if($_FILES['imagePath']['size'][$key] > 5242880){
	    		$errors[]='File size must be less tham 5 MB';
    		}	
		
			$percent = 0.5;
			list($width, $height) = getimagesize($tmp_name);
			$newwidth = $width * $percent;
			$newheight = $height * $percent;
			$thumbnail = imagecreatetruecolor($newwidth, $newheight);
      		if ($file_ext == 'jpeg') {
      			$img = imagecreatefromjpeg($tmp_name);
      		}
     	 	else if ($file_ext == 'jpg') {
      			$img = imagecreatefromjpeg($tmp_name);      
      		}
      		else if ($file_ext == 'gif') {
      			$img = imagecreatefromgif($tmp_name);      
      		}
      		$photo = addslashes($_FILES['imagePath']['tmp_name'][$key]);
      		$photo = file_get_contents($photo);
			imagecopyresized($thumbnail, $img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
/***
      ob_start();
      imagejpeg($photo);
      $contentsphoto =  ob_get_contents();
      ob_end_clean();
		//$photo = base64_encode($contentsphoto);
		$photo = $contentsphoto;
***/
      	ob_start();
     	imagejpeg($thumbnail);
      	$contentsthumbnail =  ob_get_contents();
      	ob_end_clean();
		//$thumbnail = base64_encode($contentsthumbnail);
		$thumbnail = $contentsthumbnail;
		$thumbnailblob = oci_new_descriptor($conn, OCI_D_LOB);
		$photoblob = oci_new_descriptor($conn, OCI_D_LOB);
		$insertquery = "INSERT INTO images VALUES (:photo_id, :username, :permission, :subject, :place, :timing, :description, empty_blob(), empty_blob() ) RETURNING thumbnail, photo INTO :thumbnail, :photo";
		$stid1 = oci_parse($conn, $insertquery);
        oci_bind_by_name($stid1, ":photo_id", $photo_id);
        oci_bind_by_name($stid1, ":username", $username);
        oci_bind_by_name($stid1, ":permission", $access);
        oci_bind_by_name($stid1, ":subject", $subject);
        oci_bind_by_name($stid1, ":place", $place);
        oci_bind_by_name($stid1, ":timing", $date);
        oci_bind_by_name($stid1, ":description", $description);
        oci_bind_by_name($stid1, ":thumbnail", $thumbnailblob, -1, OCI_B_BLOB);
        oci_bind_by_name($stid1, ":photo", $photoblob, -1, OCI_B_BLOB);
        oci_execute($stid1, OCI_DEFAULT);
        
        if (($thumbnailblob->save($thumbnail)) && ($photoblob->save($photo))) {
        oci_commit($conn);
        } else {
        oci_rollback($conn);
        }
}
	oci_close($conn);
	?>
    </body>
</html>
