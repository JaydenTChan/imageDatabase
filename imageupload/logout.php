<!-- Module to log the user out of the website -->
<html>
    <head>
        <title>Logout</title>
    </head>
    <body>
        <%@ page import="java.sql.*" %>
        <%
            //If a user enters this page, it will invalidate the session and then
            //redirect user to main.jsp
            session.removeAttribute("username");
            session.invalidate();
            <!-- Change home.html to whatever the directory is -->
            response.sendRedirect("login.html");
            %>
    </body>
</html>
