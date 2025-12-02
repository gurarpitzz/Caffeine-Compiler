<?php
// ✅ Start session safely (only once)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Database connection settings
$host = "localhost";
$user = "root";       // Default username in XAMPP
$pass = "";           // Default password (keep blank)
$dbname = "coffeeshop_db"; // Your database name

// ✅ Create connection
$conn = mysqli_connect($host, $user, $pass, $dbname);

// ✅ Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
