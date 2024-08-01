<?php
    require_once("config.php");

    $conn = mysqli_connect($host, $user, $pass, $db);
    if($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    } else {
        echo "Connection Made";
    }
?>