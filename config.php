<?php
    session_start();

    $user = "root";
    $pass = "";
    $server = "localhost";
    $dbname = "mms";

    try{
        $conn = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
    } catch (PDOExeption $e){
        echo "error: " . $e->getMessage();
    }