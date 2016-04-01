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
            <h1>Groups</h1>
            <p></p>
            <html>
                
                <body>
                    
                    <div class="content">
                        
                        <hr>
                        
                        <!-- TODO: Change action to spl php -->
                        <form name="GroupManagement" method="post">
                            <table>
                                <tbody>
                                    <tr>
                                        <th>Group Name: <span class="requiredField">*</span></th>
                                        <td><input type="text" maxlength="24" size="24" name="groupname"></td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td>
                                            
                                            <input type="submit" name="submit" value="Create">
                                                
                                            <!-- Change onclick location -->
                                            <input type="button" value="Cancel" onclick="location.href='user.php'">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                        <?php if (isset ($_POST['submit'])){createGroup($_POST['groupname']);} ?>
                        
                        <form name="groupForm" method="post">
                        	<?php getUserOwnerGroups(); ?>
                        	<input type="submit" name="edit" value="Edit">
                        	<input type="submit" name="delete" value="Delete">
                        </form>
                        <?php 
                        if(isset($_POST['edit'])){
                        	//Pass the group id as a session variable
                        	$_SESSION["group"]=$_POST['groupList'];
                        	header('Location: groupSingle.php');
                        	}
                        if(isset($_POST['delete'])){
                        	deleteGroup($_POST['groupList']);
                        	header('Refresh:0');
                        }
                        
                        ?>
                        
                    </div>
                </body>
                
            </html>
        </section>
        
        <footer>
            Copyright
        </footer>
        
    </body>
</html>
