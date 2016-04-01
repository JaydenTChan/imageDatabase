<?php
session_start();
include("php/PHPconnectionDB.php");
$conn=connect();
function getres($sql,$conn) {
    $stid = oci_parse($conn,$sql);
    $res = oci_execute($stid);
    while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
        foreach($row as$item)   {
            echo '<option>'.$item.'</option>';
        }
    }
}
	    
		if (!$conn) {
    		$e = oci_error();
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    }
		$user=$_SESSION['user'];
		$photo_id = $_GET['id'];
			//echo "hello $user";
			
		$sql='select * from images where photo_id=\''.$photo_id.'\'';
		//echo $sql;
	    //Prepare sql using conn and returns the statement identifier
	    $stid = oci_parse($conn, $sql);
	    
	    //Execute a statement returned from oci_parse()
	    $res=oci_execute($stid);
	    
	    while ($row=oci_fetch_array($stid,OCI_BOTH)){
	    	//echo "good";
	    	$photo_id= $row[0]; 
	    	$owner_name=$row[1];
	    	$permitted=$row[2];
	    	$subject=$row[3];
	    	$place=$row[4];
	    	$date=strtotime($row[5]);
	    	$newdate=date('d-m-Y', $date);
	    	$description=$row[6];
	    	$thumbnail=$row[7];
	    	$photo=$row[8];
	    }
	    
	    oci_free_statement($stid);
	    
		$sql='INSERT INTO image_views VALUES('.$photo_id.',\''.$user.'\')';
		//echo $sql;
	    //Prepare sql using conn and returns the statement identifier
	    $stid = oci_parse($conn, $sql);
	    
	    //Execute a statement returned from oci_parse()
	    $res=@oci_execute($stid);

	    oci_free_statement($stid);
	    oci_close($conn);

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/hawt.css">
    </head>
    <body>
        
        <header>
            <h1>Image Upload</h1>
        </header>
             	<ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="search.php">Search</a></li>
            <li><a href="upload.php">Upload Image</a></li>
            <li><a href="user.php">Account</a></li>
            <li style ="float:right"><a href="logout.php">Log Out</a></li>
            <li style ="float:right"><a href="help.php">Help</a></li>
            <?php 
            	if ($_SESSION["user"] == "admin") { ?>
            	<li style ="float:right"><a href="dataanalysis.php">Data Analysis</a></li>
            <?php } ?>
        </ul>
        <nav>
         
        </nav>
        
        <!-- This is the section with the datas and the functions -->
        <section>
            <h1>Image</h1>
            <p></p>
            <!DOCTYPE html PUBLIC "-//w3c//dtd html 4.0 transitional//en">
            <html>
                
                <head>
                    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
                        <title>View Image</title>
                </head>
                
                <body>
                    
                    <div class="content">
                        <p class="pageTitle">View Image</p>
                        
                        <p>

                            <?php 
                            	echo '<a href="user.php">View My Profile</a> | <a href="editimage.php?id='.$photo_id.'&type=photo">Edit Image</a> | <a href="php/deleteimage.php?id='.$photo_id.'&type=photo">Remove Image</a>';
                            ?>
                    
                            </p>
                            
                            <hr>
                            
                            <table>
                                <tbody>
                                    <tr>
                                    	<?php echo "<th>Owner: </th><td>" .$owner_name. " </td>"; ?>
                                        <!-- <th>Owner: </th>
                                        <td>${ownerName}</td> -->
                                    </tr>
                                    <tr>
	                                    <?php echo "<th>Subject: </th><td>" .$subject. " </td>"; ?>
                                        <!-- <th>Subject: </th>
                                        <td>${subject}</td> -->
                                    </tr>
                                    <tr>
                                    	<?php echo "<th>Place: </th><td>" .$place. " </td>"; ?>
                                        <!-- <th>Place: </th>
                                        <td>${place}</td> -->
                                    </tr>
                                    <tr>
                                    	<?php echo "<th>Date: </th><td>" .$newdate. " </td>"; ?>
                                        <!-- <th>Date / Time: </th>
                                        <td>${date}</td> -->
                                    </tr>
                                    <tr>
                                    	<?php echo "<th>Description: </th><td>" .$description. " </td>"; ?>
                                        <!-- <th>Description: </th>
                                        <td>${description}</td> -->
                                    </tr>
                                    <tr>
                                    	<?php echo "<th>Access: </th><td>" .$permitted. " </td>"; ?>
                                        <!-- <th>Access: </th>
                                        <td>${access}</td> -->
                                    </tr>
                                </tbody>
                            </table>
                            


                            <?php
								echo '<a href="php/getFullImage.php?id='.$photo_id.'&type=photo"><img src ="php/getFullImage.php?id='.$photo_id.'&type=photo" width="600px"/></a>'
                            ?>

                        
                            </div>
                </body>
            </html>
        </section>
        
        <footer>
            Copyright
        </footer>
        
    </body>
</html>
