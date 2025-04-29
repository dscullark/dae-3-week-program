<?php
// db.php
$host = 'localhost';   // Database server
$user = 'root';         // Database username (MAMP default is 'root')
$pass = 'root';         // Database password (MAMP default is 'root')
$dbname = 'latest_news_db'; // The database name you created

// Create connection
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Check connection
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}
?>
