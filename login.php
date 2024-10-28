<?php
// Start the session only if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include the filter file only once
include_once 'filter.php';

// Initialize an empty array for registered users (for demonstration)
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    if ($_POST['action'] === 'login') {
        // Sanitize and validate user input for login
        $username = filter_input_data($_POST["username"]);
        $password = filter_input_data($_POST["password"]);

        // Check for empty inputs
        if (empty($username) || empty($password)) {
            $loginError = "Please enter both username and password.";
        } else {
            // Check against registered users
            $loginSuccess = false;
            foreach ($_SESSION['users'] as $user) {
                if ($user['username'] === $username && password_verify($password, $user['password'])) {
                    // Store session variable
                    $_SESSION["loggedin"] = true;
                    $_SESSION["username"] = $username;

                    // Set persistent cookie for the username
                    setcookie("loggedInUser", $username, time() + (86400 * 30), "/"); // 30-day cookie

                    // Redirect to file.php (your team profile page)
                    header("Location: file.php"); // Updated line
                    exit();
                }
            }

            // If no match found
            $loginError = "Invalid username or password.";
        }
    } elseif ($_POST['action'] === 'signup') {
        // Sanitize and validate user input for sign up
        $newUsername = filter_input_data($_POST["new_username"]);
        $newPassword = filter_input_data($_POST["new_password"]);

        // Check for empty inputs
        if (empty($newUsername) || empty($newPassword)) {
            $signupError = "Please enter both username and password.";
        } else {
            // Check if the username already exists
            if (!in_array($newUsername, array_column($_SESSION['users'], 'username'))) {
                // Store the new user in the session
                $_SESSION['users'][] = [
                    'username' => $newUsername,
                    'password' => password_hash($newPassword, PASSWORD_DEFAULT) // Hash the password
                ];
                $signupSuccess = "Registration successful! You can now log in.";
            } else {
                $signupError = "Username already exists. Please choose another.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            padding: 30px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            text-align: left;
            color: #555;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #feb47b;
            border-radius: 8px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #ff7e5f;
            outline: none;
        }

        input[type="submit"] {
            background-color: #ff7e5f;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.2s;
        }

        input[type="submit"]:hover {
            background-color: #feb47b;
            transform: scale(1.05);
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }

        .success-message {
            color: green;
            margin-top: 10px;
        }

        .form-section {
            display: none;
        }

        .active {
            display: block;
        }

        .toggle-button {
            background-color: transparent;
            border: none;
            color: #ff7e5f;
            cursor: pointer;
            font-size: 16px;
            margin-top: 15px;
            transition: color 0.3s;
        }

        .toggle-button:hover {
            color: #feb47b;
        }
    </style>
    <script>
        function toggleForm(form) {
            document.getElementById('loginForm').classList.remove('active');
            document.getElementById('signupForm').classList.remove('active');

            if (form === 'login') {
                document.getElementById('loginForm').classList.add('active');
            } else {
                document.getElementById('signupForm').classList.add('active');
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Welcome</h2>
        <button class="toggle-button" onclick="toggleForm('login')">Login</button>
        <button class="toggle-button" onclick="toggleForm('signup')">Sign Up</button>

        <!-- Login Form -->
        <div id="loginForm" class="form-section active">
            <form method="POST" action="login.php">
                <input type="hidden" name="action" value="login">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <input type="submit" value="Login">
            </form>
            <?php if (isset($loginError)): ?>
                <div class="error-message"><?php echo $loginError; ?></div>
            <?php endif; ?>
        </div>

        <!-- Sign-Up Form -->
        <div id="signupForm" class="form-section">
            <form method="POST" action="login.php">
                <input type="hidden" name="action" value="signup">
                <label for="new_username">Username:</label>
                <input type="text" id="new_username" name="new_username" required>
                <label for="new_password">Password:</label>
                <input type="password" id="new_password" name="new_password" required>
                <input type="submit" value="Sign Up">
            </form>
            <?php if (isset($signupError)): ?>
                <div class="error-message"><?php echo $signupError; ?></div>
            <?php elseif (isset($signupSuccess)): ?>
                <div class="success-message"><?php echo $signupSuccess; ?></div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>






