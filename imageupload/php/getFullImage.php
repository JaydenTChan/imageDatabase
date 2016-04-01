<?php
//http://stackoverflow.com/questions/7793009/how-to-retrieve-images-from-mysql-database-and-display-in-an-html-tag
//Make sure there is no whitespace before <?php and no echo statements in the script, because otherwise the wrong HTTP header will be sent and the browser won't display the image properly. If you have problems, comment out the header() function call and see what is displayed.
//how to use <img src="pullimage.php?id=1&type=thumbnail" width="175" height="200" />
// do some validation here to ensure id is safe
	$myblobid = $_GET['id'];;
	$myimgtype = $_GET['type'];
	include("PHPconnectionDB.php");
	$conn=connect();
	$query = "SELECT ".$myimgtype." FROM images WHERE photo_id= :MYBLOBID";
	$stmt = oci_parse ($conn, $query);
	oci_bind_by_name($stmt, ':MYBLOBID', $myblobid);
	oci_execute($stmt);
	$arr = oci_fetch_array($stmt, OCI_ASSOC);
	$myimgtype = strtoupper($myimgtype);
	$result = $arr[$myimgtype]->load();
	header("Content-type: image/jpg");
	echo $result;
	oci_close($conn);
?>
