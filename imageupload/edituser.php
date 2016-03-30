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
            <h1>Account</h1>
            <p></p>
            <html>
                
                <head>
                    <title>Edit User Profile</title>
                </head>
                
                <body>
                    
                    <div class="content">
                        
                        <p class="pageTitle">Edit User Profile</p>
                        
                        <hr>
                        
                        <!-- Change action to jsp/php -->
                        <form name="AccountManagement" action="edituser.jsp" method="post">
                            <table>
                                <tbody>
                                    
                                    <tr>
                                        <th>Username: <span class="requiredField">*</span></th>
                                        <td><input type="text" maxlength="24" name="username" value="${username}" readonly="readonly"></td>
                                    </tr>
                                    <tr>
                                        <th>Password: <span class="requiredField">*</span></th>
                                        <td><input type="password" maxlength="24" name="password" value="${password}"></td>
                                    </tr>
                                    <tr>
                                        <th>First name: <span class="requiredField">*</span></th>
                                        <td><input type="text" maxlength="24" name="firstname" value="${firstname}"></td>
                                    </tr>
                                    <tr>
                                        <th>Last name: <span class="requiredField">*</span></th>
                                        <td><input type="text" maxlength="24" name="lastname" value="${lastname}"></td>
                                    </tr>
                                    <tr>
                                        <th>Address: <span class="requiredField">*</span></th>
                                        <td><input type="text" maxlength="128" name="address" value="${address}"></td>
                                    </tr>
                                    <tr>
                                        <th>Email: <span class="requiredField">*</span></th>
                                        <td><input type="text" maxlength="128" name="email" value="${email}"></td>
                                    </tr>
                                    <tr>
                                        <th>Phone number: <span class="requiredField">*</span></th>
                                        <td><input type="text" maxlength="10" size="10" name="phone" value="${phone}"></td>
                                    </tr>           
                                    <tr>
                                        <th></th>
                                        <td>
                                            <input type="submit" value="Submit">
                                                <!-- Change location -->
                                                <input type="button" value="Cancel" onclick="location.href='ViewProfile?${username}'">

                                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                        
                        <br>
                        
                    </div>
                    
                </body>
                
            </html>
        </section>
        
        <footer>
            Copyright
        </footer>
        
    </body>
</html>
