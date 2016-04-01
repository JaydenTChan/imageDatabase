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
			//echo "hello $user";
			
		//$sql='select * from images where owner_name=\''.$user.'\' AND photo_id=\'819741609\'';
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
	    	
	    //$sql1='select * from images where owner_name=\''.$user.'\' AND photo_id=\'819741609\'';
	    $sql1='select count(*) from images where owner_name=\''.$user.'\'';
	    $stmt = oci_parse ($conn, $sql1);
	    $items=oci_execute($stmt);
	    echo "hu $items";

        //$arr = oci_fetch_array($stmt, OCI_ASSOC);
                            	
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
	    	
	    oci_free_statement($stmt);
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
            width:700px;
            float:left;
            padding:10px;
        }
        footer {
            /*position:relative;*/
            bottom: 0;
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

            <!-- <INPUT TYPE="button" VALUE="Display" onclick="location.href='search.php'" class="button"><br> -->

            <INPUT TYPE="button" VALUE="Search" onclick="location.href='search.php'" class="button"><br>
            <INPUT TYPE="button" VALUE="Upload" onclick="location.href='upload.php'" class="button"><br>
                
            <!-- Might not need. Can remove from other pages.
            <INPUT TYPE="button" VALUE="Group" onclick="location.href='group.php'" class="button"><br> -->
                
            <!-- Only shows this if account is "admin" -->
			<?php 
            	if ($_SESSION["user"] == "admin") { ?>
            	<INPUT TYPE="button" VALUE="Data Analysis" onclick="location.href='dataanalysis.php'" class="button"><br>
            <?php } ?>
                
            <INPUT TYPE="button" VALUE="Account" onclick="location.href='user.php'" class="button"><br>
                
            <!-- Might not need it -->
            <INPUT TYPE="button" VALUE="Help" onclick="location.href='help.php'" class="button"><br>

            <!-- TODO: Add logout.jsp -->
            <INPUT TYPE="button" VALUE="Logout" onclick="location.href='logout.php'" class="button">
            
                
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
                            	echo "User: " .$user. "<br>";
                            	echo "Photo_id: " .$photo_id. "<br>";
                            	
                            	//echo '<img src ="php/getFullImage.php?id='.$photo_id.'&type=photo" width="600px"/>';				
                            	echo "number of image: " .$number. "<br>";
                            	for($i=$number; $i>0; $i--) {
								echo '<a href="viewimage.php?id='.$photo_id.'&type=photo" target="_blank"><img src ="php/getFullImage.php?id='.$photo_id.'&type=photo" width="200px" length="200px" height="200px"/></a>';
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
