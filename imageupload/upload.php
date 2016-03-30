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
                                    $("#date").datepicker({dateFormat:"dd/mm/yy"});
                                    });
                                  });
                            </script>
                </head>
                
                <body>
                    
                    <div class="content">
                        <p>
                        <a href="uploadmulti.php">Upload Multiple Images</a>
                        </p>
                        
                        <hr>
                        
                        <!-- Change action -->
                        <form name="uploadImage" method="POST" enctype="multipart/form-data" action="php/uploadSingle.php">
                            <table>
                                <tr>
                                    <th>File path: <span class="requiredField">*</span></th>
                                    <td><input name="imagePath" size="30" type="file"></td>
                                </tr>
                                <tr>
                                    <th>Subject: </th>
                                    <td><input name="subject" id="subject" size="50" maxlength="128" type="text"></td>
                                </tr>
                                <tr>
                                    <th>Place: </th>
                                    <td><input name="place" id="place" size="50" maxlength="128" type="text"></td>
                                </tr>
                                <tr>
                                    <th>Date: </th>
                                    <td>
                                        <input name="date" id="date" class="date-picker" maxlength="10"/>
                                        <span class="formHintText">(dd/MM/yyyy)</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Description: </th>
                                    <td><textarea name="description" id="description" rows="4" cols="57" maxlength="2048"></textarea></td>
                                </tr>
                                <tr>
                                    <th>Access: <span class="requiredField">*</span></th>
                                    <td>
                                        <select name="access">
                                           <?php
                        			echo $groups;
                        
                        		?>
                                                </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><br><input name="SubmitR" id="SumbitR" value="Upload" type="submit"></td>
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
