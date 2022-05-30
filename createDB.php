<?php 
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpassword = '';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpassword);

    if (!$conn) {
        echo "Failed to connect database.<br>";
    }

    echo "Connected Successfully.<br>";
    $sql = 'CREATE DATABASE bowleat';

    if (mysqli_query($conn,$sql)) {
        echo "Database created successfully.<br>";
    } else {
        echo "Failed to create database.";
    }
    mysqli_close($conn);
?>