<?php
    $basedir = realpath(__DIR__);
    require_once ($basedir.'/../config/dbconnect.php');

    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $birthday = $_POST["birthday"];
    $phonenumber = $_POST["phonenumber"];
    $city = $_POST["city"];

    $sql = "UPDATE addressbooks SET name='$name', email='$email', birthday='$birthday', phonenumber='$phonenumber', city='$city' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: /"); 
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();