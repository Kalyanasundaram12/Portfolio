<?php
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$number = $_POST["number"];
$subject = $_POST["subject"];

if (empty($firstname) || empty($lastname) || empty($email) || empty($number) || empty($subject)) {
    die("Error: All input fields are required");
}

if (!preg_match('/^[A-Za-z\s]+$/', $firstname) || !preg_match('/^[A-Za-z\s]+$/', $lastname)) {
    die("Error: Name must consist of only alphabets and white spaces");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Error: Invalid email address");
}

if (!preg_match('/^[0-9]{10}$/', $number)) {
    die("Error: Mobile number must consist of 10 digits only");
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

$hostname = 'localhost';
$username = 'root';
$password = 'root';
$database = 'portfolio';

$connection = mysqli_connect($hostname, $username, $password, $database);
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Step 2: Retrieve form data (Note: Redundant code removed)
$name = mysqli_real_escape_string($connection, $firstname);
$lastname = mysqli_real_escape_string($connection, $lastname);

$query = "INSERT INTO form (firstname, lastname, email, number, subject)
          VALUES ('$firstname', '$lastname', '$email', '$number', '$subject')";

$result = mysqli_query($connection, $query);
if ($result) {
    echo "Data successfully stored in the database.";
} else {
    echo "Error: " . mysqli_error($connection);
}

mysqli_close($connection);
?>
