<?php
    $host = 'localhost';
    $db   = 'director-schedule';
    $user = 'root';
    $pass = ''; 
    // $charset = 'utf8mb4';

    // $conn  = "mysql:host=$host;dbname=$db;charset=$charset";

    // try{
    //     $pdo = new PDO($conn, $user, $pass); 
    //     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     echo "connected to server";
    // } catch(PDOException $e){
    //     throw new PDOException($e->getMessage());
    // }

	$connection = mysqli_connect($host, $user, $pass);
    $db = mysqli_select_db($connection, "director-schedule");

    date_default_timezone_set("Asia/Dhaka");

