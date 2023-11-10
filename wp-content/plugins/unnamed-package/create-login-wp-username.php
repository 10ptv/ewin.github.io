<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted username, email, and password
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate the input and check if the username is available
    // Perform any other necessary checks and database queries here

    // Insert the user information into the "customer-list" table
    // Perform the necessary database queries here

    // Redirect the user to the appropriate page after successful registration
    header('Location: /login.php'); // Replace with the URL of your login page
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <style>
        body {
            background-color: green;
        }
        h1 {
            color: white;
        }
    </style>
</head>
<body>
    <h1>Create an Account</h1>
    <form method="POST" action="custom-registration.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Register</button>
    </form>
</body>
</html>