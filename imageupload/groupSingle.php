<?php
include("php/groupLoad.php");
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
	    <h1>Group Management</h1>
	    <p></p>
	    <html>
                
                <head>
                    <title>Group Management</title>
                </head>
                
                <body>
                    
                    <div class="content">

                        <hr>
                        
                        <!-- Management Form -->
                        <?php 
                        echo '<p>Group ID: ' . $_SESSION["group"] . '</p>';
                        loadGroup($_SESSION["group"]);
                        
                        if(isset($_POST['delete'])){
                        	removeFriendFromGroup($_SESSION["group"], $_POST['friendList']);
                        }
                        
                        if(isset($_POST['change'])){
                        	saveGroup($_SESSION["group"], $_POST['groupName']);
                        }
                        ?>
                        
                        <form method="post">
                        	<label for="friendText">Add User</label>
                        	<input type="text" name="addFriend" id="friendText">
                        	<input type="submit" value="Add" name="Add" class="button"><br>
                        </form>
                        <?php 
                        	if(isset($_POST['Add'])){
                        		addFriendToGroup($_SESSION["group"], $_POST['addFriend']);
                        	}
                        ?>
                    </div>
                    
                    <br><br>
                    <form method="post" action="group.php">
                    	<input type="submit" value="Back to Groups" class="button">
                    </form>
                </body>
                
            </html>
        </section>
        
        <footer>
            Copyright
        </footer>
        
    </body>
</html>
