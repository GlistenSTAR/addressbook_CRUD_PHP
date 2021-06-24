<?php
    $DB_HOST = "localhost";
    $DB_USERNAME = "root";
    $DB_PASSWORD = "";
    $DB_NAME = "addressbooks";
    $conn = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    
    if ($conn->connect_errno) {
        echo "Error: " . $conn->connect_error;
    }