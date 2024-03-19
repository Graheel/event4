<?php
// Establish database connection
$hostname = "localhost:3306";
$username = "root";
$password = ""; // Assuming no password is set for the database
$database = "graheel";

// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login form submission
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // TODO: Implement proper sanitization and prevent SQL injection
    $sql = "SELECT * FROM register WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        echo "Login successful";
        header("Location: index.html");
        // Redirect or perform other actions after successful login
    } else {
        echo "Invalid email or password";
    }
}

// Handle signup form submission
if (isset($_POST['signup'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match";
        // Handle error or display appropriate message
        exit(); // Stop further execution
    }

    // Proceed with signup
    $sql = "INSERT INTO register (email, password) VALUES ('$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Signup successful";
        // Redirect or perform other actions after successful signup
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}   
?>