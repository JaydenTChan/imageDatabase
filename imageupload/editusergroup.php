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
            <h1>Group</h1>
            <p></p>
            <html>
                
                <head>
                    
                </head>
                
                <body>
                    
                    <div class="content">
                        
                        <p class="pageTitle">Add/Remove Users To/From Groups</p>
                        
                        <hr>
                        
                        <!-- action to php/jsp file -->
                        <form name="UserManagement" action="UserManagement" method="post">
                            <table>
                                <tbody>
                                    <tr>
                                        <th>Group name: <span class="requiredField">*</span></th>
                                        <td>
                                            <select name="groups">
                                                <c:forEach items="${groups}" var="group">
                                                    <option value="${group[0]}">${group[1]}</option>
                                                    </c:forEach>
                                                    </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Username: <span class="requiredField">*</span></th>
                                        <td>
                                            <input type="text" maxlength="24" name="username">
                                                </td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td>
                                            <input type="submit" name="submit" value="Add">
                                            <input type="submit" name="submit" value="Remove">
                                                
                                            
                                            <input type="button" value="Cancel" onclick="location.href='user.php'">
                                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </body>
                
            </html>
        </section>
        
        <footer>
            Copyright
        </footer>
        
    </body>
</html>
