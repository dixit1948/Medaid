<?php
session_start();
require "connect.php";

if (isset($_POST['s1'])) {
    $e = $_POST['email'];
    $p = $_POST['password'];

    // check if user exists
    $qry = "SELECT * FROM tbl_admin_login WHERE email='$e' AND password='$p'";
    $res = mysqli_query($cn, $qry);

    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];

        header("Location: ./dashbord.php");
        exit();
    } else {
        $error = "Invalid Email or Password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>GameVerse Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', sans-serif;
    }
    .login-card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 12px;
      padding: 30px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0px 4px 15px rgba(0,0,0,0.2);
    }
    .login-card h3 {
      text-align: center;
      font-weight: bold;
      margin-bottom: 20px;
      color: #203a43;
    }
    .form-control {
      border-radius: 8px;
    }
    .btn-login {
      border-radius: 8px;
      background: #203a43;
      border: none;
      transition: background 0.3s ease;
    }
    .btn-login:hover {
      background: #2c5364;
    }
    .footer-text {
      text-align: center;
      font-size: 14px;
      margin-top: 15px;
      color: #555;
    }
    .footer-text a {
      text-decoration: none;
      color: #203a43;
      font-weight: 600;
    }
    .footer-text a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="login-card">
    <h3>GameVerse Login</h3>
    <?php if (!empty($error)) { ?>
      <div class="alert alert-danger text-center"><?php echo $error; ?></div>
    <?php } ?>
    <form method="post">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="email" class="form-control" placeholder="Enter your email" name="email" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" placeholder="Enter your password" name="password" required>
      </div>
      <button type="submit" name="s1" class="btn btn-dark w-100 btn-login">Login</button>
    </form>
    <div class="footer-text">
      
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>