<?php
$servername = "127.0.0.1";
$username = "root";
$password = "kali";
$dbName = "site_db";

$link = mysqli_connect($servername, $username, $password);

if (!$link) {
    die('Error: ' . mysqli_connect_error());
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbName";

if (!mysqli_query($link, $sql)){
    echo "Unable to create Database ";
}

mysqli_close($link);

$link = mysqli_connect($servername, $username, $password, $dbName);

$sql = "CREATE TABLE IF NOT EXISTS users(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    pass VARCHAR(50) NOT NULL
)";

if (!mysqli_query($link, $sql)){
    echo "Unable to create Table users";
}

$sql = "CREATE TABLE IF NOT EXISTS posts(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(20) NOT NULL,
    main_text VARCHAR(400) NOT NULL
)";

if (!mysqli_query($link, $sql)){
    echo "Unable to create Table Posts";
}

mysqli_close($link);
?>