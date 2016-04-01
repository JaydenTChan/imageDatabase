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
            <h1>Upload Single Image</h1>
            <p></p>
            <!DOCTYPE html PUBLIC "-//w3c//dtd html 4.0 transitional//en">
            <html>
                
                <head>
                    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
                        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
                        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
                        <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">
                            <script type="text/javascript">
                                $(function() {
                                  $(function(){
                                    $("#date").datepicker({dateFormat:"dd-mm-yy"});
                                    });
                                  });
                            </script>
                </head>
                
                <body>
                    
                    <div class="content">
                        <p>
                        <a href="uploadmulti.php" class="button">Upload Multiple Images</a>

                        </p>
                        
                        <hr>
                        
                        <!-- Change action -->
                        <form name="uploadImage" method="POST" enctype="multipart/form-data" action="php/uploadSingle.php">
                            <table>
                                <tr>
                                    <th>File path: <span class="requiredField">*</span></th>
                                    <td><input id="image[]" name="image[]" size="30" type="file" class="dropdown"></td>
                                </tr>
                                <tr>
                                    <th>Subject: </th>

                                    <td><input name="subject" size="50" maxlength="128" type="text" class="dropdown"></td>
                                </tr>
                                <tr>
                                    <th>Place: </th>
                                    <td><input name="place" size="50" maxlength="128" type="text" class="dropdown"></td>

                                </tr>
                                <tr>
                                    <th>Date: </th>
                                    <td>
                                        <input name="date" id="date" class="date-picker" maxlength="10"/>
                                        <span class="formHintText">(DD-MM-YYYY)</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Description: </th>

                                    <td><textarea name="description" id="description" rows="4" cols="57" maxlength="2048" class="dropdown"></textarea></td>

                                </tr>
                                <tr>
                                    <th>Access: <span class="requiredField">*</span></th>
                                    <td>
                                        <select name="access" class="dropdown">

                                            <?php 
                                            	getres("select distinct group_name, group_id from groups");
                                            	?>

                                                </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><br><input name=".submit" value="Upload" type="submit" class="button"></td>
                                </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </body>
            </html>
        </section>
        
        <footer>
            Copyright
        </footer>
        
    </body>
</html>
