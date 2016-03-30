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
            <h1>Edit Image</h1>
            <p></p>
            <!DOCTYPE html PUBLIC "-//w3c//dtd html 4.0 transitional//en">
            <html>
                
                <head>
                    <title>Edit Image</title>
                    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
                    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
                    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
                    <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">
                    <script type="text/javascript">
                        $(function(){
                        $("#date").datepicker({dateFormat:"dd/mm/yy"});
                        });
                    </script>
                </head>
                
                <body>
                    
                    <div class="content">
                        
                        <p class="pageTitle">Edit Image</p>
                        
                        <p>
                        
                        <!-- Change a href to view current user and image name -->
                        <a href="user.php">View My Profile</a> |
                        <a href="viewimage.php">View Image</a> |
                        <a href="deleteimage.php">Remove Image</a>
                        <!-- Need to make deleimage.php -->
                        </p>
                        
                        <hr>
                        
                        <!-- Change action -->
                        <form name="editImage" method="POST" action="editimage.php">
                            <table>
                                <tbody>
                                    <tr>
                                        <th>Subject:</th>
                                        <td><input name="subject" size="50" maxlength="128" type="text" value="${subject}"></td>
                                    </tr>
                                    <tr>
                                        <th>Place:</th>
                                        <td><input name="place" size="50" maxlength="128" type="text" value="${place}"></td>
                                    </tr>
                                    <tr>
                                        <th>Date:</th>
                                        <td><input name="date" id="date" class="date-picker" maxlength="10" value="${date}"/>
                                            <span class="formHintText">(DD/MON/YYY)</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Time:</th>
                                        <td><input name="time" maxlength="5" value="${time}"/>
                                            <span class="formHintText">(hh:mm)</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Description:</th>
                                        <td><textarea name="description" rows="4" cols="57" maxlength="2048">${description}</textarea></td>
                                    </tr>
                                    <tr>
                                        <th>Access: <span class="requiredField">*</span></th>
                                        <td>
                                            <select name="access">
                                                
                                                <!-- Change this -->
                                                <c:forEach items="${groups}" var="group">
                                                    <c:choose>
                                                        <c:when test="${access == group[1]}">
                                                            <option value="${group[1]}" selected=true>${group[0]}</option>
                                                            </c:when>
                                                            <c:otherwise>
                                                                <option value="${group[1]}">${group[0]}</option>
                                                                </c:otherwise>
                                                                </c:choose>
                                                                </c:forEach>
                                                                </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td>
                                            <br><input name=".submit" value="Save" type="submit">
                                                <input value="Cancel" type="button" onclick="location.href='ViewImage?${picId}'">
                                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                        
                        <!-- Change a href and img src to get the image picked
                        <p><a href="/PhotoWebApp/GetFullImage?${picId}" target="_blank"><img src ="/PhotoWebApp/GetFullImage?${picId}" ></a></p> -->
                        
                        <!-- delete this when top is fixed -->
                        <p><a href="test.jpg" target="_blank"><img src ="test.jpg" width="600px"></a></p>
                        
                        
                        
                    </div>
                </body>
            </html>
        </section>
        
        <footer>
            Copyright
        </footer>
        
    </body>
</html>
