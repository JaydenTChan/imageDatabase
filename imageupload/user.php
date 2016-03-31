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
	    	
	    
	    //$row=oci_fetch_array($stid,OCI_BOTH)
	    oci_free_statement($stid1);
	    	
	    
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
            <INPUT TYPE="button" VALUE="Group" onclick="location.href='group.php'" class="button"><br>
                            
                            <!-- Only shows this if account is "admin" -->
            <?php 
            	if ($_SESSION["user"] == "admin") { ?>
            	<INPUT TYPE="button" VALUE="Data Analysis" onclick="location.href='dataanalysis.php'" class="button"><br>
            <?php } ?>
                                
            <INPUT TYPE="button" VALUE="Account" onclick="location.href='user.php'" class="button"><br>
            <INPUT TYPE="button" VALUE="Help" onclick="location.href='help.php'" class="button"><br>
            <INPUT TYPE="button" VALUE="Logout" onclick="location.href='logout.php'" class="button">
                                            
                                        
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
                        <p class="pageTitle">My Profile</p>
                        
                        <hr>
                        
                        <p class="pageTitle">Account:</p>
                        <a href="edituser.php">Edit Account Information</a>
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
                        
                        <p class="pageTitle">Groups:</p>
                        
                        <a href="group.php">Create/Delete Groups</a> | <a href="editusergroup.php">Add/Remove Users To/From Groups</a>
                        
                        <p>
                        <table>
                            <tbody>
                                <tr>
                                    <th>Group Name</th>
                                    <th>Members</th>
                                </tr>
                                <c:forEach items="${groups}" var="group" varStatus="groupLoop">
                                    <tr>
                                        <td>${group}</td>
                                        <td>
                                            <c:forEach items="${groupMembers[groupLoop.index]}" var="member">
                                                ${member}  &nbsp;
                                                </c:forEach>
                                                </td>
                                    </tr>
                                    </c:forEach>
                                    </tbody>
                        </table>
                        </p>
                        
                        
                        <p class="pageTitle">Images:</p>
                        
                        <a href="upload.php">Upload Single Image</a> |
                        <a href="uploadmulti.php">Upload Multiple Images</a>
                        <br><br>
                        <table>
                            <tbody>
                                <tr>
                                    <!-- Next 2 line is just for test. Not needed -->
                                    <a href="test.jpg"><img src ="test.jpg" width="200px">
                                    <a href="test2.jpg"><img src ="test2.jpg" width="200px">
                                    <!-- Change this to search image this account uploaded
                                    <c:forEach items="${imageIds}" var="imageId">
                                        <a href="/PhotoWebApp/ViewImage?${imageId}"><img src ="/PhotoWebApp/GetThumbnailImage?${imageId}"></a>
                                        </c:forEach> -->
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
