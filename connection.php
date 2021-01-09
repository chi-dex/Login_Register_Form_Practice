<?php

    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "my_first_database";

    //create connection to database
    $conn = mysqli_connect( $server, $username, $password, $db);

    if(!$conn){
        die(" connection failed: ".mysqli_connect_error());
    }
?>