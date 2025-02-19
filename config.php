<?php

// Database configuration
$db_config = [
    'servername' => 'localhost', 
    'username' => 'root',
    'password' => '',
    'dbname' => 'barbearia'
];

// Function to get database connection
function get_db_connection() {
    global $db_config;

    $conn = new mysqli(
        $db_config['servername'], 
        $db_config['username'], 
        $db_config['password'], 
        $db_config['dbname']
    );

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }

    return $conn;
}?>