<?php include('db.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Daftar Akun</title>
</head>
<body>
    <div class="login-box">
     <p>Daftar Akun</p>
  <form method="POST" action="">
    <div class="user-box">
        <label>Nama</label><br>
      <input required="name" name="name" type="name" required>
      
    </div>
    <div class="user-box"> 
        <label>Alamat</label><br>
        <textarea name="address" placeholder="Alamat" required></textarea>
     
    </div>
    <div class="user-box">
        <label>Tanggal Lahir</label><br>
    <input type="date" name="birth_date" required><br>
      
    </div>
    <div class="user-box">
        <label>Nomor HP</label><br>
    <input type="text" name="phone" required><br>
      
    </div> 
    <div class="user-box">
        <label>Email</label><br>
    <input type="email" name="email" required><br>
      
    </div>
    <div class="user-box">
        <label>Password</label><br>
    <input type="password" name="password" required><br>
      
    </div>
    <a>
      <button type="submit" name="register">daftar</button>
    </a>
  </form>
  <p>Already have an account? <a href="index.php" class="a2">Login!</a></p>
</div>

    <?php
    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $birth_date = $_POST['birth_date'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $grade = 'C'; 

        $query = "INSERT INTO users (name, address, birth_date, phone_number, email, password, grade)
                  VALUES ('$name', '$address', '$birth_date', '$phone', '$email', '$password', '$grade')";
       if (mysqli_query($conn, $query)) {
        header('Refresh: 0; URL=index.php');
    }    
    }
    ?>
</body>
</html>
