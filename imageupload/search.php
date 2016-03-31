<?php
//Start the session
session_start();
include("PHPconnectionDB.php");
include("index.php");
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
            <INPUT TYPE="button" VALUE="Logout" onclick="location.href='logout.jsp'" class="button">
                                            
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
                        
                        <form name="Search" method="POST" action="Search">
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
                                    <td ALIGN=CENTER COLSPAN="2"><input type="submit" name=".submit" value="Search"></td>
                                </tr>
                            </table>
                            </div>
                    	</form>
			<?php
				if (isset ($_POST['Search'])){
				    indexImages();
				
				    //get the input
				    $k_words=$_POST['keywords'];
				    $fr_date=$_POST['fromDate'];
				    $to_date=$_POST['toDate'];
				    $sort=$_POST['SortBy'];
			
				    ini_set('display_errors', 1);
				    error_reporting(E_ALL);
				    
				    //establish connection
				    $conn=connect();
				    if (!$conn) {
			    		$e = oci_error();
			    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				    }
				    
				    //Add ands
				    $k_words = str_replace(' ', ' AND ', $k_words);
			 	
				    //sql command
				    
				    $sql = array(
				    '
				    SELECT photo_id FROM images 
				    WHERE CONTAINS(subject, \'' . $k_words . '\', 1) > 0 
				    OR CONTAINS(place, \'' . $k_words . '\', 2) > 0
				    OR CONTAINS(description, \'' . $k_words . '\', 3) > 0
				    ORDER BY timing ASC',
				    '
				    SELECT photo_id FROM images 
				    WHERE CONTAINS(subject, \'' . $k_words . '\', 1) > 0 
				    OR CONTAINS(place, \'' . $k_words . '\', 2) > 0
				    OR CONTAINS(description, \'' . $k_words . '\', 3) > 0
				    ORDER BY timing DESC',
				    '
				    SELECT photo_id FROM images 
				    WHERE CONTAINS(subject, \'' . $k_words . '\', 1) > 0 
				    OR CONTAINS(place, \'' . $k_words . '\', 2) > 0
				    OR CONTAINS(description, \'' . $k_words . '\', 3) > 0
				    ORDER BY (6*score(1) + 3*score(2) + score(3)) DESC'
				    );
				    
				    //
				    
				    //Prepare sql using conn and returns the statement identifier
				    if($sort == 'New'){
				    	$stid = oci_parse($conn, $sql[0]);
			    	    }else if($sort == 'Old'){
			    	    	$stid = oci_parse($conn, $sql[1]);
			    	    }else{
			    	    	$stid = oci_parse($conn, $sql[2]);
			    	    }
				    
				    //Execute a statement returned from oci_parse()
				    $res=oci_execute($stid);

				    
				    //if error, retrieve the error using the oci_error() function & output an error message

				    if (!$res) {
					$err = oci_error($stid); 
					echo htmlentities($err['message']);
		
				    }
				    else{
						$row = oci_fetch_row($stid);
						if ($row == true){
							$_SESSION["user"]=$row[0];//Save the user name
							header("Location: getSession.php");
						}else {
						//Source: http://stackoverflow.com/questions/13851528/how-to-pop-an-alert-message-box-using-php
						//Source: http://stackoverflow.com/questions/19825283/redirect-to-a-page-url-after-alert-button-is-pressed
							$message = "Incorrect username/password";
							echo "<script type='text/javascript'>";
							echo "alert('$message');";
							echo "window.location.href = \"../login.html\";";
							echo "</script>";
				
						}
		
				    }
				    
				    // Free the statement identifier when closing the connection
				    oci_free_statement($stid);
				    oci_close($conn);
			    
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
