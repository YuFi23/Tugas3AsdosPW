<?php include('db.php'); session_start();
if (isset($_SESSION['user'])) {
    header('Location: profile.php');
    exit;
}
 ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
<div class="login-box">
  <p>Login</p>
  <form method="POST" action="">
    <div class="user-box">
    <label>Email</label><br>
      <input required="email" name="email" type="email" required><br>
    </div>
    <div class="user-box">
        <label>Password</label><br>
      <input required="password" name="password" type="password" re>
    </div>
    <a>
      <button type="submit" name="login">Login</button>
    </a>
  </form>
  <p>Don't have an account? <a href="register.php" class="a2">Sign up!</a></p>
</div>

<?php
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header('Location: profile.php'); // Redirect ke profil
            } else {
                echo "<p style='color:red;'>Password salah.</p>";
            }
        } else {
            echo "<p style='color:red;'>Email tidak ditemukan.</p>";
        }
    }
    ?>
    <br>

</body>
</html>
