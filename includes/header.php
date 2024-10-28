<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group 10 </title>
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

        .logo img {
            width: 150px; 
            height: auto; 
        }

}


    
        .nav-container {
            display: flex;
            align-items: center;
        }

        
        .button {
            width: 100px; /* Set a fixed width for uniform size */
            padding: 10px 0; /* Adjust padding to center text within fixed width */
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s;
            margin-left: 10px;
        }
        .button_container {
            width: 100px; /* Set a fixed width for uniform size */
            padding: 10px 0; /* Adjust padding to center text within fixed width */
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s;
            margin-left: 10px;
        }

        .button:hover {
            background-color: #0056b3; /* Same hover color for both buttons */
        }

        /* Responsive styling */
      
    </style>
</head>
<body>

<header>
    <div class="logo">
        <a href="new.php">
        <img src="g10.jpg" alt="Logo">
        </a>
    </div>
    <div class="nav-container"> 
        <button class="button" onclick="openContactModal()">Contact Us</button>
        <button class="button" onclick="logout()">Log Out</button> <!-- Both buttons styled the same -->
    </div>
</header>

<script>
    function openContactModal() {
        alert("Contact Modal Opened!");
    }

    function logout() {
        alert("Logged out successfully!");
    }
</script>

</body>
</html>











