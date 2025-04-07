<?php
    $host ="localhost";
    $user = "Marcel";
    $pass = "databasesucks";
    $db = "schmanagement";

    $conn = mysqli_connect($host, $user, $pass, $db);

     if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    


?>

