<?php 
session_start(); // Start session to manage user session data
include "connect.php"; // Include file for database connection

// Check if username and password are submitted via POST
if(isset($_POST['username']) && isset($_POST['password'])) {
    
    // Function to sanitize and validate input data
    function validate($data) {
        $data = trim($data); // Remove whitespace from beginning and end
        $data = stripslashes($data); // Remove backslashes
        $data = htmlspecialchars($data); // Convert special characters to HTML entities
        return $data; // Return sanitized data
    }

    // Sanitize and validate username and password inputs
    $user = validate($_POST['username']);
    $pass = validate($_POST['password']);

    // Check if username is empty
    if(empty($user)) {
        header("Location: login.php?error=username is required"); // Redirect with error message
        exit(); // Stop further script execution
    } else if(empty($pass)) {
        header("Location: login.php?error=password is required"); // Redirect with error message
        exit(); // Stop further script execution
    }

    // SQL query to select user with matching username and password
    $sql = "SELECT * FROM users WHERE user_name = '$user' AND user_pass = '$pass'";

    // Execute SQL query
    $result = mysqli_query($con, $sql);

    // Check if exactly one row is returned (indicating valid credentials)
    if(mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result); // Fetch associative array of the user data
        // Verify username and password match
        if($row['user_name'] === $user && $row['user_pass'] === $pass) {
            // Set session variables to store user data
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['login_success'] = true; // Set login success flag
            header("Location: edit.php"); // Redirect to settings page
            exit(); // Stop further script execution
        } else {
            header("Location: login.php?error=Incorrect username or password"); // Redirect with error message
            exit(); // Stop further script execution
        }
    } else {
        header("Location: login.php?error=Incorrect username or password"); // Redirect with error message
        exit(); // Stop further script execution
    }
} else {
    header("Location: login.php?error=Both fields are required"); // Redirect with error message
    exit(); // Stop further script execution
}

?>