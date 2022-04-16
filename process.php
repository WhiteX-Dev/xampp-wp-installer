<?php

// Include MySQL config file
require_once "config.php";

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
if (isset($_POST['name'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
}

// Creating a database named by the variable $dbname
$sql = "CREATE DATABASE $name";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully with the name <strong>" . $name . "</strong>!" . "<br>";
} else {
  echo "Error creating database: " . $conn->error;
}

// closing connection
$conn->close();

// Create a new folder with the name of the database
$new_folder = $xampp_path . $name;
mkdir($new_folder);

// Download WordPress core
chdir($new_folder);
$output = shell_exec('wp core download');
echo "WordPress core downloaded!";
