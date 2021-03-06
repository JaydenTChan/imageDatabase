<?php
//Start the session
session_start();
include("php/searchFunctions.php");
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
            <h1>Search</h1>
            <p></p>
            <html>
                
                <head>
                    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
                        <title>Search</title>
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
                        
                        <hr/>
                        
                        <form name="SearchForm" method="POST">
                            <table>
                                <tr>
                                    <th colspan="2">Search parameters:</th>
                                </tr>
                                <tr>
                                    <th>Keyword(s): </th>
                                    <td><input name="keywords" type="textfield" size="30" ></input></td>
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
                                    <th>Sort By: <span class="requiredField">*</span></th>
                                    <td>
                                        <select name="SortBy">
                                            <option value="Rank">Relevance</option>
                                            <option value="Old">Time (oldest first)</option>
                                            <option value="New">Time (newest first)</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td ALIGN=CENTER COLSPAN="2">
                                    <input type="submit" name="search" value="Search">
                                    </td>
                                </tr>
                            </table>
                            </div>
                    	</form>
			<?php
			if(isset($_POST['search'])){
				search($_POST['keywords'],$_POST['fromDate'],
				$_POST['toDate'],$_POST['SortBy']);
			}
			?>

                </body> 
            </html>
        </section>
        
        <footer>
            Copyright
        </footer>
        
    </body>
</html>
