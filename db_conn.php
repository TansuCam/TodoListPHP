<?php
    $serverName = "localhost";
    $username = "root";
    $password = "";
    $db_name = "todo";

    try{
        $conn = new PDO("mysql:host=$serverName;dbname=$db_name",
            $username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } 
    catch(PDOException $e){
        echo "connection failed : ". $e->getMessage();
    }
    
    ?>
