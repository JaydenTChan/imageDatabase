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
                    
                    <title>Data Analysis Report</title>
                        
                </head>
                
                <body>
                    
                    <div class="content">
                        
                        <p class="pageTitle">Data Analysis Report</p>
                        <p><a href="dataanalysis.php">Generate New Report</a></p>
                        <hr/>
                        
                        <!-- TODO: generate report -->
                    
                    </div>
                </body> 
            </html>
        </section>
        
        <footer>
            Copyright
        </footer>
        
    </body>
</html>
