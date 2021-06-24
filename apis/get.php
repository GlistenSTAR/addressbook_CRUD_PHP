<?php
    $basedir = realpath(__DIR__);
    require_once ($basedir.'/../config/dbconnect.php');
    
    $sql = "SELECT * FROM addressbooks";
    $result = $conn->query($sql);
    $addressbooks = [];
    if ($result->num_rows > 0) {
        $addressbooks = $result->fetch_all(MYSQLI_ASSOC);
    }