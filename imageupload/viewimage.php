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
			
		$sql='select * from images where owner_name=\''.$user.'\' AND photo_id=\''.$photo_id.'\'';
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
	    
	    //$date=strtotime(date);
	    
	    //echo $date;
	    
	    //$newdate = date('d-m-Y', $date);
	    
	    //$newdate= date('d-m-y', strtotime(date));
	    
	    //echo $newdate;
	    	
	    /*$sql1='select * from images where owner_name=\''.$user.'\' AND photo_id=\''.$photo_id.'\'';
        $stmt = oci_parse ($conn, $sql1);
        oci_execute($stmt);
        $arr = oci_fetch_array($stmt, OCI_ASSOC);*/
                            	
	    /*$sql1='select * from users where user_name=\''.$user.'\'';
	    
	    //Prepare sql using conn and returns the statement identifier
	    $stid1 = oci_parse($conn, $sql1);
	    
	    //Execute a statement returned from oci_parse()
	    $res1=oci_execute($stid1);
	    
	    while ($row=oci_fetch_array($stid1,OCI_BOTH)){
	    	//echo "good <br>";
	    	$password=$row[1];
	    	//echo "pas --" .$password. " --  <br>";
	    }*/
	    	
	    
	    //$row=oci_fetch_array($stid,OCI_BOTH)
	    //oci_free_statement($stid1);
	    	
	    //oci_free_statement($stmt);
	    //$row=oci_fetch_array($stid,OCI_BOTH)
	    oci_free_statement($stid);
	    oci_close($conn);

?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            header {
                background-color:black;
                color:white;
                text-align:center;
                font-size: 25px;
                padding:5px;
            }
        nav {
            line-height:30px;
            background-color:gray;
            height:600px;
            width:150px;
            float:left;
            padding:5px;
        }
        section {
            width:600px;
            float:left;
            padding:10px;
        }
        footer {
            background-color:black;
            color:white;
            clear:both;
            text-align:center;
            padding:5px;
        }
        .button {
            font-size: 20px;
            color: black;
        }
        </style>
    </head>
    <body>
        
        <header>
            <h1>Image Upload</h1>
        </header>
        
        <nav>
            
            <!-- change location to correct location -->
            <INPUT TYPE="button" VALUE="Home" onclick="location.href='home.php'" class="button"><br>
            <INPUT TYPE="button" VALUE="Search" onclick="location.href='search.php'" class="button"><br>
            <INPUT TYPE="button" VALUE="Upload" onclick="location.href='upload.php'" class="button"><br>
                            
            <?php 
            	if ($_SESSION["user"] == "admin") { ?>
            	<INPUT TYPE="button" VALUE="Data Analysis" onclick="location.href='dataanalysis.php'" class="button"><br>
            <?php } ?>
                                
            <INPUT TYPE="button" VALUE="Account" onclick="location.href='user.php'" class="button"><br>
            <INPUT TYPE="button" VALUE="Help" onclick="location.href='help.php'" class="button"><br>
            <INPUT TYPE="button" VALUE="Logout" onclick="location.href='logout.jsp'" class="button">
                
                                            
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

                            
                            <!-- Change this
                            <a href="ViewProfile?${ownerName}">View My Profile</a> |
                            <a href="EditImage?${picId}">Edit Image</a> |
                            <a href="RemoveImage?${picId}">Remove Image</a> -->
                            <?php 
                            	echo '<a href="user.php">View My Profile</a> | <a href="editimage.php?id='.$photo_id.'&type=photo">Edit Image</a> | <a href="deleteimage.php?id'.$photo_id.'&type=photo">Remove Image</a>';
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
                            
                            <!-- Change this
                            <a href="/PhotoWebApp/GetFullImage?${picId}" target="_blank"><img src ="/PhotoWebApp/GetFullImage?${picId}" ></a> -->
                            
                            <!-- Can delete this when the above is changed -->
                            <?php
                            	echo "User: " .$user. "<br>";
                            	echo "Photo_id: " .$photo_id. "<br>";
                            	
                            	//echo '<img src ="php/getFullImage.php?id='.$photo_id.'&type=photo" width="600px"/>';
								echo '<a href="php/getFullImage.php?id='.$photo_id.'&type=photo"><img src ="php/getFullImage.php?id='.$photo_id.'&type=photo" width="600px"/></a>'
                            	
                            ?>

                            <!--
                            <a href="<?php echo 'getFullImage.php?id='.$photo_id.'&type=photo' ?>" target="_blank"><img src ="<?php echo 'getFullImage.php?id='.$photo_id.'&type=photo' ?>">></a> -->
                            
                            </div>
                </body>
            </html>
        </section>
        
        <footer>
            Copyright
        </footer>
        
    </body>
</html>
