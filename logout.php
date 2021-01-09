<?php
    

    session_start();

    if(!$_SESSION["email"]){
        header("Location: loginForm.php");
    }
    

    //erase session variables
    session_unset();

    //destroy session
    session_destroy();

    echo "You have been logged out";

?>