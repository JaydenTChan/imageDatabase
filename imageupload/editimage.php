<?php
session_start();
include("php/PHPconnectionDB.php");

function getres($sql) {
    $conn=connect();
    $stid = oci_parse($conn,$sql);
    $res = oci_execute($stid);
    while ($row = oci_fetch_row($stid)) {
    	echo '<option value="'.$row[1].'">'.$row[0].'</option>';
    }
    oci_free_statement($stid);
    oci_close($conn);
    return;
}
$conn=connect();
	      
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
            <h1>Edit Image</h1>
            <p></p>
            <!DOCTYPE html PUBLIC "-//w3c//dtd html 4.0 transitional//en">
            <html>
                
                <head>
                    <title>Edit Image</title>
                    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
                    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
                    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
                    <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">
                    <script type="text/javascript">
                        $(function(){
                        $("#date").datepicker({dateFormat:"dd-mm-yy"});
                        });
                    </script>
                </head>
                
                <body>
                    
                    <div class="content">
                        
                        <p class="pageTitle">Edit Image</p>
                        
                        <p>
                        
                        <?php 
                            	echo '<a href="user.php">View My Profile</a> | <a href="viewimage.php?id='.$photo_id.'&type=photo">View Image</a> | <a href="php/deleteimage.php?id='.$photo_id.'&type=photo">Remove Image</a>';
                            ?>
                        </p>
                        
                        <hr>
                        
                        <!-- Change action -->
                        <form name="editImage" method="POST" action="php/updateeditimage.php?id=<?php echo $photo_id; ?>&type=photo">
                            <table>
                                <tbody>
                                    <tr>
                                        <th>Subject:</th>
                                        <td><input id= "subject" name="subject" size="50" maxlength="128" type="text" value="<?php echo $subject; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th>Place:</th>
                                        <td><input id="place" name="place" size="50" maxlength="128" type="text" value="<?php echo $place; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th>Date:</th>
                                        <td><input id="date" name="date" id="date" class="date-picker" maxlength="10" value="<?php echo $newdate; ?>"/>
                                            <span class="formHintText">(DD-MM-YYYY)</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Description:</th>
                                        <td><textarea id="description" name="description" rows="4" cols="57" maxlength="2048"><?php echo $description; ?></textarea></td>
                                    </tr>
                                    <tr>
                                        
                                        <th><?php echo "Current Access:"; ?><span class="requiredField"></span></th>
                                        <td>
                                        <?php echo $permitted; ?>
                                           
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Access: <span class="requiredField">*</span></th>
                                        <td>
                                        <?php //echo "Current Access :" .$permitted; ?>
                                            <select name="access">
                                                
                                                <!-- Change this -->
                                                <?php 
                                                    $conn = connect();
                                            	    getres("select distinct group_name, group_id from groups");
                                            	?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td>
                                            <br><input name=".submit" value="Save" type="submit">
                                                <input value="Cancel" type="button" onclick="location.href='viewimage.php?id=<?php echo $photo_id; ?>'">
                                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                        
                        <!-- Change a href and img src to get the image picked
                        <p><a href="/PhotoWebApp/GetFullImage?${picId}" target="_blank"><img src ="/PhotoWebApp/GetFullImage?${picId}" ></a></p> -->
                        <?php 
                            echo '<a href="php/getFullImage.php?id='.$photo_id.'&type=photo"><img src ="php/getFullImage.php?id='.$photo_id.'&type=photo" width="600px"/></a>';
                        ?>
                        <!-- delete this when top is fixed 
                        <p><a href="test.jpg" target="_blank"><img src ="test.jpg" width="600px"></a></p> -->
                        
                        
                        
                    </div>
                </body>
            </html>
        </section>
        
        <footer>
            Copyright
        </footer>
        
    </body>
</html>
