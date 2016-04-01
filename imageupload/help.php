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
            /*background-color:gray;*/
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
            <h1>Help</h1>
            <p></p>
            
            <hr>
            
            <h2> Instruction</h2>
            Download the tar and untar it in /compsci/webdocs/{Your CSID}/web_docs/ <br>
            	chmod -R 755 imageDatabase/ <br>
            	Goto /compsci/webdocs/{Your CSID}/web_docs/imageDatabase/sql <br>
            	Run the following command from SQL command line: <br>
            		SQL> @setup.sql <br>
            	The system should automatically install all sql tables and admin account. <br>
            	The default admin account is: <br>
            	Username: admin <br>
            	Password: admin <br>
            	Open http://consort.cs.ualberta.ca/~{Your CSID}/imageDatabase/imageupload/login.html <br>
            
            <br>
            <h3> Login </h3>
            <p> To login, either use an existing account or register a new account by click on the pencil to the right of Login. <br>
            
            <br>
            <h3> Once login </h3>
            Buttons:<br>
            Home: Goes to home page where it shows the Current user and top view images. <br>
            Search: Goes to search page. <br>
            Upload: Goes to upload page. <br>
            Data Analysis (Only shown to admin): Goes to data analysis page for admin <br>
            Account: Goes to user page where it shows profile, groups, Images. <br>
            Help: Goes to help page where is shows the user documentation. <br>
            Logout: logout of current user and return to login page. <br>
            
            <br>
            <h3> Search </h3>
            User can search by inputting into one or more search parameters and then click Search to get search result. Result is shows on the bottom if any image match the search parameters. <br>
            
            <br>
            <h3> Upload </h3>
            User can upload file by choosing an file by click on Choose File and filling in the infomation below. <br>
            User can pick from either upload multiple images or upload single image. <br>
            User can upload one image in Upload Single Image page and multiple in Upload muliple image page. <br>
            Image will only upload if an image has been picked and Access picked. <br>
            
            <br>
            <h3> Data Analysis </h3>
            Only admin will have access to this page. <br>
            
            <br>
            <h3> Account </h3>
            This page shows the user information, groups the user belong to, and images uploaded by the user. <br>
            <h5> - Edit Account Information </h5>
            This allows the user to edit their account information by changing what is in the input boxes. The change will be updated once user click Submit or goes back to user page when they click Cancel. <br>
            <br>
            <h5> - Groups </h5>
            This allow user to edit their group infomation once clicked. <br>
            They can either Create, Edit, or Delete group. Cancel will bring user back to account page.
            Once in Edit group page user can: <br> 
            Change group name by changing the text in the textbox then click Change.
            Delete users from group by clicking on Delete once they picked how to delete.
            Add new user by typing in their username in the texbox and click Add. Will display a pop-up error is user does not exist or already part of the group. <br>
            Back to Groups bring you back to group management page. <br>
            <br>
            <h5> - Images by user: </h5> 
            User can upload images by clicking on either Upload Single Image or Upload Multiple Images. <br>
            User can view image by clicking on that image which will bring they to view image page. <br>
            Once in view image page user can either go back to user profile by clicking on View My Profile or edit the image description by clicking on Edit Image or remove the image by clicking the Remove Image button. <br>
            In the edit image page, it will display the image the user is changing. User can change the description of the image by changing what is diplay in the textbox and click Save. Clicking on Cancel will bring user back to view image page. <br>
            
            <br>
            <h3> Help </h3>
            This page shows the user documentation.
            
            <br>
            <h4> Logout </h3>
            By clicking on this it end the user session and goes to the Login screen.
            

            <br>
            <br>
            <br>
            <br>
            <br>
            
            
            
            
        </section>
        
        <footer>
            Copyright
        </footer>
        
    </body>
</html>
        </section>
        
        <footer>
            Copyright
        </footer>
        
    </body>
</html>
