<?php

// Load environment variables
require_once 'config.php';

// Establish Database Connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Validate and Sanitize Input
$user_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$user_id) {
    die("Invalid user ID.");
}

// Prepare and Execute Query
$stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch User Data
if ($row = $result->fetch_assoc()) {
    echo "User: " . htmlspecialchars($row["username"], ENT_QUOTES, 'UTF-8') . "<br>";
} else {
    echo "No user found.";
}

// Cleanup
$stmt->close();
$conn->close();

?>
