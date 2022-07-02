<?php
    // Change this to your connection info.
    $DB_HOST = 'localhost';
    $DB_USER = 'root';
    $DB_PASSWORD = 'sp8xY4eA`(.#V?hw';
    $DB_NAME = 'comp3421_db';
    // Try and connect using the info above.
    //$con = new PDO('mysql:host=' . $DB_HOST . ';dbname=' . $DB_NAME . ';charset=utf8', $DB_USER, $DB_PASSWORD);
    $con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
    if ( mysqli_connect_errno() ) {
        // If there is an error with the connection, stop the script and display the error.
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
?>