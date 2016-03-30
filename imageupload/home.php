<?php
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
            width:700px;
            float:left;
            padding:10px;
        }
        footer {
            /*position:relative;*/
            bottom: 0;
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
            <!-- <INPUT TYPE="button" VALUE="Display" onclick="location.href='search.html'" class="button"><br> -->
            <INPUT TYPE="button" VALUE="Search" onclick="location.href='search.html'" class="button"><br>
            <INPUT TYPE="button" VALUE="Upload" onclick="location.href='upload.php'" class="button"><br>
                
            <!-- Might not need. Can remove from other pages.
            <INPUT TYPE="button" VALUE="Group" onclick="location.href='group.html'" class="button"><br> -->
                
            <!-- Only shows this if account is "admin" -->
	<?php 
            	if ($_SESSION["user"] == "admin") { ?>
            	<INPUT TYPE="button" VALUE="Data Analysis" onclick="location.href='dataanalysis.html'" class="button"><br>
            <?php } ?>
                
            <INPUT TYPE="button" VALUE="Account" onclick="location.href='user.html'" class="button"><br>
                
            <!-- Might not need it -->
            <INPUT TYPE="button" VALUE="Help" onclick="location.href='help.html'" class="button"><br>
                
            <!-- TODO: Add logout.jsp -->
            <INPUT TYPE="button" VALUE="Logout" onclick="location.href='logout.jsp'" class="button">
            
                
        </nav>
        
        <!-- This is the section with the datas -->
        <section>
            <h1>Image Upload</h1>
            <p>Upload and Store Image</p>
            <p></p>
            <head>
                <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
                    <title>Home</title>
            </head>
            
            <body>
                
		<?php 
		//Echo session test
		echo "User is: " . $_SESSION["user"];
		?>

                <div class="content">
                    <hr/>
                    
                    
                    <ul>
                        <c:if test='${username != null && username != ""}'>
                            
                            </c:if>
                            
                            </ul>
                    
                    <p class="pageTitle">Top Images</p>
                    
                    <table border="1" cellpadding="15px" cellspacing="0px" >
                        <tbody>
                            <tr>
                               <!--<img src="test.jpg" alt="test image" style="width:304px;height:228px;">-->
                                <a href="viewimage.html"><img src ="test.jpg" width="200px">
                                <a href="viewimage.html"><img src ="test2.jpg" width="200px">

                                    
                                    
                                <!-- Change this display top 5 image
                                 <c:forEach items="${topImages}" var="image">
                                    <a href="/PhotoWebApp/ViewImage?${image[1]}"><img src ="/PhotoWebApp/GetThumbnailImage?${image[1]}" width="50px"></a>
                                    Views: ${image[0]}
                                    </c:forEach> -->
                            </tr>
                        </tbody>
                    </table>
                </div>
            </body>
        </section>
        
        <footer>
            Copyright
        </footer>
        
    </body>
</html>
