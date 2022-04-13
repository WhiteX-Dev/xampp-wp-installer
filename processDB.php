<?php
$servername = "localhost";
$username = "root";
$password = "777";

// Check for POST variables
if (isset($_POST['dbname'])) {
  $dbname = $_POST['dbname'];
  echo 'Database name will be: ' . $dbname . '!';
}

// Creating a connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// Storing the database name
if (isset($_POST['dbname'])) {
  $dbname = mysqli_real_escape_string($conn, $_POST['dbname']);
}

// Creating a database named by the variable $dbname
$sql = "CREATE DATABASE $dbname";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully with the name " . $dbname . "!";
} else {
  echo "Error creating database: " . $conn->error;
}

// closing connection
$conn->close();
