<?php
//Start the session
session_start();
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
                        
                        <form name="DataAnalysis" method="POST" action="dataanalysisreport.php">
                            <table>
                                <tr>
                                    <th colspan="2">Please specify your parameters</th>
                                </tr>
                                <tr>
                                    <th>User: </th>
                                    <td>
                                        <select name="user">
                                            <option value="All">All</option>
                                            <c:forEach items="${users}" var="foundUser">
                                                <option value="${foundUser}">${foundUser}</option>
                                                </c:forEach> 
                                                </select>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <th>Subject: </th>
                                    <td>
                                        <select name="subject">
                                            <option value="All">All</option>
                                            <c:forEach items="${subjects}" var="foundSubject">
                                                <option value="${foundSubject}">${foundSubject}</option>
                                                </c:forEach> 
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
                                    <td ALIGN=CENTER COLSPAN="2"><input type="submit" name=".submit" value="Generate Report"></td>
                                </tr>
                            </table>
                            </div>
                    </form>
                </body> 
            </html>
        </section>
        
        <footer>
            Copyright
        </footer>
        
    </body>
</html>
