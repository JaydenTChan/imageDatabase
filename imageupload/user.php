<?php
session_start();
include("php/PHPconnectionDB.php");


function getres($sql) {
	$conn=connect();
    $stid = oci_parse($conn,$sql);
    $res = oci_execute($stid);
    while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
        foreach($row as$item)   {
            echo '<option>'.$item.'</option>';
        }
    }
}


		$conn=connect();
	    
		
			$user=$_SESSION['user'];
			//echo "hello $user";
			
			$sql='select * from Persons where user_name=\''.$user.'\'';
			//echo $sql;
	    //Prepare sql using conn and returns the statement identifier
	    $stid = oci_parse($conn, $sql);
	    
	    //Execute a statement returned from oci_parse()
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
	    	
	    $sql1='select * from users where user_name=\''.$user.'\'';
	    
	    //Prepare sql using conn and returns the statement identifier
	    $stid1 = oci_parse($conn, $sql1);
	    
	    //Execute a statement returned from oci_parse()
	    $res1=oci_execute($stid1);
	    
	    while ($row=oci_fetch_array($stid1,OCI_BOTH)){
	    	//echo "good <br>";
	    	$password=$row[1];
	    	//echo "pas --" .$password. " --  <br>";
	    }


function whatever(){  
		$conn=connect();  
		$user=$_SESSION['user'];	
		$photo_id = $_GET['id'];
	    //$sql='select * from images where owner_name=\''.$user.'\' AND photo_id=\'819741609\'';
		$sql2='select * from images where owner_name=\''.$user.'\'';
		//echo $sql;
	    //Prepare sql using conn and returns the statement identifier
	    $stid2 = oci_parse($conn, $sql2);
	    
	    //Execute a statement returned from oci_parse()
	    $res2=oci_execute($stid2);

	    //echo "number of image: " .$number. "<br>";
	    while ($row=oci_fetch_array($stid2,OCI_BOTH)){
	    	$photo_id= $row[0]; 
	    	$owner_name=$row[1];
	    	$permitted=$row[2];
	    	$subject=$row[3];
	    	$place=$row[4];
	    	$date=$row[5];
	    	$description=$row[6];
	    	$thumbnail=$row[7];
	    	$photo=$row[8];
	    	echo '<a href="viewimage.php?id='.$photo_id.'&type=photo"><img src ="php/getFullImage.php?id='.$photo_id.'&type=photo" width="200px" length="200px" height="200px"/> </a>';
	  	}
	    //echo "number of image: " .$number. "<br>";
	    

	    oci_free_statement($stid2);
	    
	    //$row=oci_fetch_array($stid,OCI_BOTH)
	    oci_close($conn);
	    
    	return;
}
		oci_free_statement($stid);
	    oci_free_statement($stid1);
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
            <h1>User Profile</h1>
            <p></p>
            <!DOCTYPE html PUBLIC "-//w3c//dtd html 4.0 transitional//en">
            <html>
                
                <head>
                    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
                        <link type="text/css" rel="stylesheet" href="/PhotoWebApp/resources/style/style.css"/>
                        <title>View User (${userFirstName} ${userLastName} - ${username})</title>
                </head>
                
                <body>

                    <div class="content">
                        
                        <hr>
                        <a href="edituser.php" class="button">Edit Account Information</a>
                        <p>
                        <table>
                            <tbody>
                                <tr>
                                    <!-- <th>Username: </th>
                                    <td>${username}</td> 
                                    <?php echo "this --- " .$user . "<br>"; ?> -->
                                    <?php echo "<th>Username: </th><td>" .$username. " </td>"; ?>
                
                                </tr>
                                <tr>
                                    <!-- <th>First Name: </th>
                                    <td>${userFirstName}</td> -->
                                     <?php echo "<th>First name: </th><td>" .$firstname. "<br>"; ?> 
                                </tr>
                                <tr>
                                    <!--<th>Last Name: </th>
                                     <td>${userLastName}</td>-->
                                     <?php echo "<th>Last name: </th><td>" .$lastname. "<br>"; ?>        
                                </tr>
                                
                                <tr>
                                    <!-- <th>Address: </th>
                                    <td>${address}</td> 
                                    <?php echo "Address: $address"; ?>  <br>-->
                                    <?php echo "<th>Address: </th><td>" .$address. "<br>"; ?>
                                    
                                    
      	                        </tr>
                                <tr>
                                    <!-- <th>Email: </th>
                                    <td>${email}</td> 
                                    <?php echo "Email: $email"; ?>  <br> -->
                                    <?php echo "<th>Email: </th><td>" .$email. "<br>"; ?>
                                    
                                </tr>
                                <tr>
                                    <!-- <th>Phone number: </th>
                                    <td>${phone}</td> 
                                    <?php echo "Phone: $phone"; ?>   <br> -->
                                    <?php echo "<th>Phone: </th><td>" .$phone. "<br>"; ?>
                                    
                                </tr>
                            </tbody>
                        </table>

                        <p>
                        
                        <H1>This user belongs to the group(s):</H1>
                        
                        

                    	<?php
                    	getres("
                    	SELECT DISTINCT group_name 
                    	FROM groups, group_lists
                    	WHERE (groups.group_id = group_lists.group_id AND 
                    	friend_id =  '" .$_SESSION["user"]. "') OR
                    	(user_name = '" .$_SESSION["user"]. "')
                    	");
                        
                        if ($_SESSION["user"] == 'admin'){
	                        echo "private";
                        }   	
                        ?>

                        </p>
                        <form action="group.php">
	                        <input type="submit" value="Groups" class="button"><br>
                        </form>
                        
                        
                        <h1>Images by this user:</h1>
                        
                        <a href="upload.php" class="button">Upload Single Image</a> 
                        <a href="uploadmulti.php" class="button">Upload Multiple Images</a>
                        <br><br>
                        <table>
                            <tbody>
                                <tr>
                                	<?php whatever(); ?>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </body>
            </html>
        </section>
        
        <footer>
            Copyright
        </footer>
        
    </body>
</html>
