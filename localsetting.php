<?php
    $hostname = "localhost";
    $username = "root";
    $password = "Cordova022201";
    $db_name = "pracphp";

    try{
        $conn = new PDO("mysql:host=$hostname;dbname=$db_name", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected Successfully";
    }
    catch(PDOException $e){
        echo "Connection Failed" .$e->$getMessage();
    }
?>