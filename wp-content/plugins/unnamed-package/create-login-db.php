<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the input and check if the username and password match the database records
    // Perform the necessary database queries here

    // Redirect the user to the appropriate page based on the login result
    if ($login_successful) {
        header('Location: /dashboard.php'); // Replace with the URL of your dashboard page
        exit;
    } else {
        $error_message = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Seang Rithy</title>
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
    <h1>Login to Your Account</h1>
    <?php if (isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
    <?php } ?>
    <form method="POST" action="login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</body>
</html>