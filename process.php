<?php

// Include global config file (local file ignored by Git)
require_once "config.php";

// MySQL Commands follow next lines ============================================ //

// // Check for POST variables
// if (isset($_POST['dbname'])) {
//   $dbname = $_POST['dbname'];
//   echo 'Database name will be: ' . $dbname . '!';
// }

// Creating a MySQL connection
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


// Creating a new folder for WordPress ========================================= //

// Create a new folder with the name of the database
$new_folder = $xampp_path . $name;
mkdir($new_folder);

// WP-CLI Commands follow next lines =========================================== //

// WP-CLI variables
$sfx = ' 2>&1'; // Storing suffing for WP-CLI commands
$wp_url = 'http://localhost/' . $name; // Storing the URL of the new WordPress

// Changing command line to the new folder
chdir($new_folder);

// Download WordPress core
$output_core = shell_exec('wp core download' . $sfx);
echo "<pre>$output_core</pre>";

$output_config = shell_exec('wp core config --dbname=' . $name . ' --dbuser=' . $username . ' --dbpass=' . $password . $sfx);
echo "<pre>$output_config</pre>";

$output_install = shell_exec('wp core install --url=' . $wp_url . ' --title="Let\'call this site "' . $name . ' --admin_user=admin --admin_password=admin --admin_email=' . $admin_email . $sfx);
echo "<pre>$output_install</pre>";

echo "Access front-end here: <a href=" . $wp_url . " target=\"_blank\">" . $wp_url . "</a><br>";
echo "Access back-end here: <a href=" . $wp_url . "/wp-admin target=\"_blank\">" . $wp_url . "/wp-admin</a><br>";
echo "Here you go. Enjoy!";
