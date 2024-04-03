<?php
session_start();

$servername = "localhost";
$username = "u152146582_nextgencareer";
$password = "Nextgen@2023";
$database = "u152146582_nextgencareer";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['mobile'])) {
    $mobile = $_POST['mobile'];

    // Check if mobile number is already registered
    $check_query = "SELECT * FROM users WHERE mobile='$mobile'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        echo "registered";
    } else {
        echo "not_registered";
    }
} else {
    echo "invalid_request";
}

$conn->close();
?>
