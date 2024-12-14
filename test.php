<?php
    include 'model/db_connection.php';
    $p = new connectDB();
    $conn = $p->connect();
    if ($conn) {
        echo "Connection successful!";
    } else {
        echo "Connection failed!";
    }
?>

