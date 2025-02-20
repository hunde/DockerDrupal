<?php
// Connect to database (Potential SQL Injection Vulnerability)
$conn = new mysqli("localhost", "root", "", "test_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from query parameter
$user_id = $_GET['id'];

// SQL Query without Prepared Statements (Vulnerable to SQL Injection)
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "User: " . $row["username"] . "<br>";
    }
} else {
    echo "No user found.";
}

// Close connection
$conn->close();
?>
