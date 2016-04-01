<?php
include("php/groupLoad.php");
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
