<?php
    $basedir = realpath(__DIR__);
    require_once ($basedir.'/../config/dbconnect.php');

    $id = $_GET["id"];

    $sql = "DELETE FROM addressbooks WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: /"); 
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();