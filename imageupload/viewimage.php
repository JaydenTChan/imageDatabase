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
            <h1>Image</h1>
            <p></p>
            <!DOCTYPE html PUBLIC "-//w3c//dtd html 4.0 transitional//en">
            <html>
                
                <head>
                    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
                        <title>View Image</title>
                </head>
                
                <body>
                    
                    <jsp:include page="resources/includes/header.jsp" />
                    
                    <div class="content">
                        <p class="pageTitle">View Image</p>
                        
                        <p>
                        <c:if test='${ownerName==username}'>
                            
                            <!-- Change this
                            <a href="ViewProfile?${ownerName}">View My Profile</a> |
                            <a href="EditImage?${picId}">Edit Image</a> |
                            <a href="RemoveImage?${picId}">Remove Image</a> -->
                            
                            <a href="user.php">View My Profile</a> |
                            <a href="editimage.php">Edit Image</a> |
                            <a href="deleteimage.php">Remove Image</a>
                    
                            </c:if>
                            </p>
                            
                            <hr>
                            
                            <table>
                                <tbody>
                                    <tr>
                                        <th>Owner: </th>
                                        <td>${ownerName}</td>
                                    </tr>
                                    <tr>
                                        <th>Subject: </th>
                                        <td>${subject}</td>
                                    </tr>
                                    <tr>
                                        <th>Place: </th>
                                        <td>${place}</td>
                                    </tr>
                                    <tr>
                                        <th>Date / Time: </th>
                                        <td>${date}</td>
                                    </tr>
                                    <tr>
                                        <th>Description: </th>
                                        <td>${description}</td>
                                    </tr>
                                    <tr>
                                        <th>Access: </th>
                                        <td>${access}</td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <!-- Change this
                            <a href="/PhotoWebApp/GetFullImage?${picId}" target="_blank"><img src ="/PhotoWebApp/GetFullImage?${picId}" ></a> -->
                            
                            <!-- Can delete this when the above is changed -->
                            <a href="test2.jpg" target="_blank"><img src ="test2.jpg" width="600px"></a>
                            
                            </div>
                </body>
            </html>
        </section>
        
        <footer>
            Copyright
        </footer>
        
    </body>
</html>