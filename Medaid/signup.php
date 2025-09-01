<?php
$conn = new mysqli("localhost", "root", "", "medical_db");

$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $password = trim($_POST["password"]);

    // Insert user into DB
    $sql = ("INSERT INTO client (username, email, phone, password) VALUES ('$username','$email','$phone','$password')");
    $stmt = $conn->prepare($sql);
    

    if ($stmt->execute()) {
        $success = "Account created successfully! <a href='signin.php'> </a>";
    } else {
        $error = "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="stylesheet" href="assets/css/signup.css">
  <!-- 🔹 Import header.css -->
</head>
<body>

  <!-- 🔹 Import Header -->

  <div class="signup-container">
    <h2>Create Account</h2>

    <?php if ($success) echo "<p class='success'>$success</p>"; ?>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>

    <form method="POST" action="">
      <input type="text" name="username" placeholder="Enter Username" required>
       <input type="email" name="email" placeholder="Enter Email" 
       pattern="[a-zA-Z0-9._%+-]+@gmail\.com" 
       title="Only Gmail addresses allowed" required>
       <input type="tel" 
       name="phone" 
       placeholder="Enter Phone Number" 
       pattern="[6-9][0-9]{9}" 
       maxlength="10"
       required 
       title="Phone number must start with 6, 7, 8, or 9 and be exactly 10 digits long">


      <input type="password" name="password" placeholder="Enter Password" required>
      <button type="submit">Sign Up</button>
    </form>

    <p>Already have an account? <a href="login.php">Login</a></p>
  </div>



</body>
</html>
