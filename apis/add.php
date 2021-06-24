<?php
    $basedir = realpath(__DIR__);
    require_once ($basedir.'/../config/dbconnect.php');

    $name = $_POST["name"];
    $email = $_POST["email"];
    $birthday = $_POST["birthday"];
    $phonenumber = $_POST["phonenumber"];
    $city = $_POST["city"];

    $sql = "INSERT INTO addressbooks (name, email, birthday, phonenumber, city) VALUES ('$name', '$email', '$birthday', '$phonenumber', '$city')";

    if ($conn->query($sql) === TRUE) {
        header("Location: /"); 
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();