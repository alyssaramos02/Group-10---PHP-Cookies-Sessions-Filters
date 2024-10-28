<?php
// Start the session
session_start();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: login.php");
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 20px;
            background-color: #f8f9fa;
        }

        .logo {
            margin-right: 20px;
        }

        .logo img.landscape-logo {
            height: 150px;
            width: auto;
            transform: rotate(90deg);
            transform-origin: left;
        }

        .nav-container {
            display: flex;
            align-items: center;
        }

        .button {
            margin-left: 10px;
            padding: 10px 15px;
            background-color: #007BFF; /* Same background color for both buttons */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #0056b3; /* Same hover color for both buttons */
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            .logo img.landscape-logo {
                height: 100px;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <a href="new.php">
            <img src="includes/g10.jpg" alt="Logo" class="landscape-logo">
        </a>
    </div>
    <div class="nav-container"> 
        <button class="button" onclick="openContactModal()">Contact Us</button>
        <button class="button" onclick="logout()">Log Out</button>
    </div>
</header>

<script>
    function openContactModal() {
        alert("Contact Modal Opened!");
    }

    function logout() {
        // Redirect to logout.php which handles session destruction
        window.location.href = "logout.php"; // Ensure you have this logout.php file
    }
</script>

</body>
</html>


