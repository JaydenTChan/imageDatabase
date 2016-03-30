
<?php 
    if(!isset($_SESSION)) { //check if sessions has been initialized
        session_start();	//initialize session
    }   
    $_SESSION = array();
    // Finally, destroy the session.
    session_destroy();
    header("Location:login.html");
?>
