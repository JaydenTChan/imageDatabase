<?php
//Start the session
session_start();
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
