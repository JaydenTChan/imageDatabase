<?php
session_start();
include("php/PHPconnectionDB.php");

$conn=connect();
if (!$conn) {
	$e = oci_error();
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$user=$_SESSION['user'];
$sql='select * from images where owner_name=\''.$user.'\'';
//echo $sql;
//Prepare sql using conn and returns the statement identifier
$stid = oci_parse($conn, $sql);

//Execute a statement returned from oci_parse()
$res=oci_execute($stid);

$number=0;

while ($row=oci_fetch_array($stid,OCI_BOTH)){
//echo "good";
	$number++;
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

$sql1='select count(*) from images where owner_name=\''.$user.'\'';
$stmt = oci_parse ($conn, $sql1);
$items=oci_execute($stmt);

oci_free_statement($stmt);
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
            <li style ="float:right"><a href="help.php">Help</a></li>
            <?php 
            	if ($_SESSION["user"] == "admin") { ?>
            	<li style ="float:right"><a href="dataanalysis.php">Data Analysis</a></li>
            <?php } ?>
            <li style ="float:right"><a href="logout.php">Log Out</a></li>
        </ul>
        
        <nav>
            
        </nav>
        
        <!-- This is the section with the datas -->
        <section>
            <h1>Image Upload</h1>
            <p>Upload and Store Image</p>
            <p></p>
            <head>
                <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
                    <title>Home</title>
            </head>
            
            <body>
                
		<?php 
		//Echo session test
			echo "User is: " . $_SESSION["user"];
		?>

                <div class="content">
                    <hr/>
                    
                    
                    <ul>
                        <c:if test='${username != null && username != ""}'>
                            
                            </c:if>
                            
                            </ul>
                    
                    <p class="pageTitle">Top Images</p>
                    
                    <table border="1" cellpadding="15px" cellspacing="0px" >
                        <tbody>
                            <tr>
                            <?php
                            	//echo "User: " .$user. "<br>";
                            	//echo "Photo_id: " .$photo_id. "<br>";
                            	
                            	//echo '<img src ="php/getFullImage.php?id='.$photo_id.'&type=photo" width="600px"/>';				
                            	//echo "number of image: " .$number. "<br>";
                            	for($i=$number; $i>0; $i--) {
					echo '<a href="viewimage.php?id='.$photo_id.'&type=photo"><img src ="php/getFullImage.php?id='.$photo_id.'&type=photo" width="200px" length="200px" height="200px"/></a>';
								}
                            	
                            ?>
                                <!--<img src="test.jpg" alt="test image" style="width:304px;height:228px;">
                                <a href="viewimage.php"><img src ="test.jpg" width="200px" length="200px" height="200px"/></a>
                                <a href="viewimage.php"><img src ="test2.jpg" width="200px" length="200px" height="200px"/></a>-->

                                    
                                    
                                <!-- Change this display top 5 image
                                 <c:forEach items="${topImages}" var="image">
                                    <a href="/PhotoWebApp/ViewImage?${image[1]}"><img src ="/PhotoWebApp/GetThumbnailImage?${image[1]}" width="50px"></a>
                                    Views: ${image[0]}
                                    </c:forEach> -->
                            </tr>
                        </tbody>
                    </table>
                </div>
            </body>
        </section>
        
        <footer>
            Copyright
        </footer>
        
    </body>
</html>
