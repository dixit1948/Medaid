<?php
session_start();
// Show errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "medical_db";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Database is not reachable: " . $conn->connect_error);
}


// Handle form submission
if (isset($_POST['submit'])) {
    $email = $_POST['username'];
    $pass = $_POST['password'];

    $res= $conn->query("select * from client where email='$email' and password='$pass'"); 
    if ($res->num_rows > 0) {
        while($row = $res->fetch_assoc())
        {
            $_SESSION["username"] = $email;
            $_SESSION["id"] = $row["user_id"];
            header("Location: ./index.php");
        }
        
    } else {
        echo  "Invalid email or password";
    }
}
?>

<!-- CSS Styling -->
<style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #74ebd5, #9face6);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        flex-direction: column; /* so error box comes on top */
    }

    .error-popup {
        background: #ff4d4d;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: bold;
        margin-bottom: 20px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        animation: slideDown 0.5s ease;
    }

    @keyframes slideDown {
        from { transform: translateY(-100%); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    form {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0px 8px 20px rgba(0,0,0,0.15);
        width: 320px;
        text-align: center;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 6px;
        text-align: left;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 8px;
        border: 1px solid #ccc;
        outline: none;
        transition: border 0.3s;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
        border: 1px solid #6a11cb;
    }

    input[type="submit"] {
        width: 100%;
        padding: 10px;
        border: none;
        background: #6a11cb;
        color: white;
        font-size: 16px;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s;
    }

    input[type="submit"]:hover {
        background: #2575fc;
    }
</style>

<!-- HTML Login Form -->
<body>
    

    <div class="login-container"> 
    
<form method="post" action="">
    <label>Email:</label>
    <input type="text" name="username" required><br><br>
    <label>Password:</label>
    <input type="password" name="password" required><br><br>
    <input type="submit" name="submit" value="Login">
</form>
</div>
