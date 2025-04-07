<?php
    $host ="localhost";
    $user = "Marcel";
    $pass = "databasesucks";
    $db = "schmanagement";

    $conn = mysqli_connect($host, $user, $pass, $db);
    if ($conn)
    {
        echo "Connection Successful";
    }
    else
    {
        echo "Connection Failed";
    }

    


?>

