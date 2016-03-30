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
            <h1>User Profile</h1>
            <p></p>
            <!DOCTYPE html PUBLIC "-//w3c//dtd html 4.0 transitional//en">
            <html>
                
                <head>
                    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
                        <link type="text/css" rel="stylesheet" href="/PhotoWebApp/resources/style/style.css"/>
                        <title>View User (${userFirstName} ${userLastName} - ${username})</title>
                </head>
                
                <body>
                    
                    <jsp:include page="resources/includes/header.jsp" />
                    
                    <div class="content">
                        <p class="pageTitle">My Profile</p>
                        
                        <hr>
                        
                        <p class="pageTitle">Account:</p>
                        <a href="edituser.jsp">Edit Account Information</a>
                        <p>
                        <table>
                            <tbody>
                                <tr>
                                    <th>Username: </th>
                                    <td>${username}</td>
                                </tr>
                                <tr>
                                    <th>First Name: </th>
                                    <td>${userFirstName}</td>
                                </tr>
                                <tr>
                                    <th>Last Name: </th>
                                    <td>${userLastName}</td>
                                </tr>
                                <tr>
                                    <th>Phone number: </th>
                                    <td>${phone}</td>
                                </tr>
                                <tr>
                                    <th>Email: </th>
                                    <td>${email}</td>
                                </tr>
                                <tr>
                                    <th>Address: </th>
                                    <td>${address}</td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <p class="pageTitle">Groups:</p>
                        
                        <a href="group.php">Create/Delete Groups</a> | <a href="editusergroup.php">Add/Remove Users To/From Groups</a>
                        
                        <p>
                        <table>
                            <tbody>
                                <tr>
                                    <th>Group Name</th>
                                    <th>Members</th>
                                </tr>
                                <c:forEach items="${groups}" var="group" varStatus="groupLoop">
                                    <tr>
                                        <td>${group}</td>
                                        <td>
                                            <c:forEach items="${groupMembers[groupLoop.index]}" var="member">
                                                ${member}  &nbsp;
                                                </c:forEach>
                                                </td>
                                    </tr>
                                    </c:forEach>
                                    </tbody>
                        </table>
                        </p>
                        
                        
                        <p class="pageTitle">Images:</p>
                        
                        <a href="upload.php">Upload Single Image</a> |
                        <a href="uploadmulti.php">Upload Multiple Images</a>
                        <br><br>
                        <table>
                            <tbody>
                                <tr>
                                    <!-- Next 2 line is just for test. Not needed -->
                                    <a href="test.jpg"><img src ="test.jpg" width="200px">
                                    <a href="test2.jpg"><img src ="test2.jpg" width="200px">
                                    <!-- Change this to search image this account uploaded
                                    <c:forEach items="${imageIds}" var="imageId">
                                        <a href="/PhotoWebApp/ViewImage?${imageId}"><img src ="/PhotoWebApp/GetThumbnailImage?${imageId}"></a>
                                        </c:forEach> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </body>
            </html>
        </section>
        
        <footer>
            Copyright
        </footer>
        
    </body>
</html>