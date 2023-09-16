<?php
    
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "kering";

    #connect the site to the database

    $connect = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    #if no connection established
        
    if (!$connect) {
        
        echo "Unable to connect to db!";
    }