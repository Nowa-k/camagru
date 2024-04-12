<?php
$host = 'mysql-service';   // MySQL server hostname within the same Docker network
$user = 'db_user';    // MySQL username
$pass = 'password';   // MySQL password
$db = 'test_database';// MySQL database name

// Create a new MySQLi object to establish a database connection
$conn = new mysqli($host, $user, $pass, $db);

// Check if the connection was successful
if ($conn->connect_error) {
    // Display an error message and terminate the script if the connection fails
    die("Connection failed: " . $conn->connect_error);
}

// If the connection is successful, print a success message
echo "PHP Connected to MySQL successfully";


/// Create table 

// $sql = "CREATE TABLE users (
//     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     username VARCHAR(30) NOT NULL,
//     email VARCHAR(50)
//     )";

// if ($conn->query($sql)) {
//     echo 'Table create';
// } else {
//     echo 'Failed to create table';
// }
// Close the database connection

/// Show tables
$showTables = mysqli_query($conn, "SHOW TABLES FROM $db");
$tables = mysqli_fetch_array($showTables);
foreach ($tables as $table) {
    var_dump($table);
}
$conn->close();
?>