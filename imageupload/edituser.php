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
	    	echo "good <br>";
	    	$usern= $row[0]; 
	    	$password=$row[1];
	    	echo "pas --" .$password. " --  <br>";
	    }
	    	
	    
	    //$row=oci_fetch_array($stid,OCI_BOTH)
	    oci_free_statement($stid);
	    oci_free_statement($stid1);
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
            <INPUT TYPE="button" VALUE="Data Analysis" onclick="location.href='dataanalysis.php'" class="button"><br>
                                
            <INPUT TYPE="button" VALUE="Account" onclick="location.href='user.php'" class="button"><br>
            <INPUT TYPE="button" VALUE="Help" onclick="location.href='help.php'" class="button"><br>
            <INPUT TYPE="button" VALUE="Logout" onclick="location.href='logout.php'" class="button">
                
        </nav>
        
        <!-- This is the section with the datas and the functions -->
        <section>
            <h1>Account</h1>
            <p></p>
            <html>
                
                <head>
                    <title>Edit User Profile</title>
                </head>
                
                <body>
                    
                    <div class="content">
                        
                        <p class="pageTitle">Edit User Profile</p>
                        
                        <hr>
                        
                        <!-- Change action to jsp/php -->
                        <form name="AccountManagement" action="php/edituserprofile.php" method="post">
                            <table>
                                <tbody>
                                    
                                    <tr>
                                        <th>Username: <span class="requiredField">*</span></th>
                                        <td><input type="text" maxlength="24" name="username" value=" <?php echo $username; ?>" readonly="readonly"></td>
                                    </tr>
                                    <tr>
                                        <th>Password: <span class="requiredField">*</span></th>
                                        <td><input type="text" id="password" maxlength="24" name="password" value="<?php echo $password; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th>First name: <span class="requiredField">*</span></th>
                                        <td><input type="text" id="firstname" maxlength="24" name="firstname" value="<?php echo $firstname; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th>Last name: <span class="requiredField">*</span></th>
                                        <td><input type="text" id="lastname" maxlength="24" name="lastname" value="<?php echo $lastname; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th>Address: <span class="requiredField">*</span></th>
                                        <td><input type="text" id="address" maxlength="128" name="address" value="<?php echo $address; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th>Email: <span class="requiredField">*</span></th>
                                        <td><input type="text" id="email" maxlength="128" name="email" value="<?php echo $email; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th>Phone number: <span class="requiredField">*</span></th>
                                        <td><input type="text" id="phone" maxlength="10" size="10" name="phone" value="<?php echo $phone; ?>"></td>
                                    </tr>           
                                    <tr>
                                        <th></th>
                                        <td>
                                            <input type="submit" id="Submit" value="Submit">
                                                <!-- Change location -->
                                                <input type="button" value="Cancel" onclick="location.href='user.php'">

                                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                        
                        <br>
                        
                    </div>
                    
                </body>
                
            </html>
        </section>
        
        <footer>
            Copyright
        </footer>
        
    </body>
</html>
