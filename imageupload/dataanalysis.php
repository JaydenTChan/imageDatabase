<?php
//Start the session
session_start();
include("php/PHPconnectionDB.php");
include("php/data.php");
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
            <h1>Data Analysis</h1>
            <p></p>
            <html>
                
                <head>
                    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
                    <title>Data Analysis</title>
                    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
                    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
                    <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">
                    <script type="text/javascript">
                        $(function(){
                        $("#toDate").datepicker({dateFormat:"dd/mm/yy"});
                        $("#fromDate").datepicker({dateFormat:"dd/mm/yy"});
                        });
                    </script>
                </head>
                
                <body>
                    
                    <div class="content">
                        
                        <p class="pageTitle">Data Analysis</p>
                        
                        <hr/>
                        
                        <form name="DataAnalysis" method="POST">
                            <table>
                                <tr>
                                    <th colspan="2">Please specify your parameters</th>
                                </tr>
                                <tr>
                                    <th>User: </th>
                                    <td>
                                        <select name="user">
                                            <option value="All">All</option>
                                            <option value="None">None</option>
                                            <?php populateUsers(); ?>
                                        </select>
                                        
                                    </td>
                                </tr>                               
                                <tr>
                                    <th>Subject: </th>
                                    <td><input type = "text" class = "dropdown" name = "subject">Type ALL to query all subjects</input></td>
                                </tr>
                                <tr>
                                	<th>Grouping: </th>
                                	<td>
                                		<select name="date">
                                			<option value="Weekly">Weekly</option>
                                			<option value="Monthly">Monthly</option>
                                			<option value="Yearly">Yearly</option>
                                		</select>
                                	</td>
                                </tr>
                                <tr>
                                    <th>From Date: </th>
                                    <td><input name="fromDate" type="textfield" id="fromDate" class="date-picker" maxlength="10" size="10"/> <span class="formHintText">(dd/MM/yyyy)</span></td>
                                </tr>
                                <tr>
                                    <th>To Date: </th>
                                    <td><input name="toDate" type="textfield" id="toDate" class="date-picker" maxlength="10" size="10"/> <span class="formHintText">(dd/MM/yyyy)</span></td>
                                </tr>
                                
                                <tr>
                                    <td ALIGN=LEFT COLSPAN="2"><input type="submit" name="generate" value="Generate Report" class="button"></td>
                                </tr>
                            </table>
                            </div>
                            
                            <?php if (isset($_POST['generate'])){
                            	getData($_POST['user'], $_POST['subject'], $_POST['date'],$_POST['toDate'], $_POST['fromDate']);
                            }
                            ?>
                    </form>
                </body> 
            </html>
        </section>
        
        <footer>
        	<?php getUserCount(); getImageCount(); getViews();?>
        	<br>
            Copyright
        </footer>
        
    </body>
</html>
