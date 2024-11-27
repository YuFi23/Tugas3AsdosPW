<?php include('db.php'); session_start(); ?>
<?php if (!isset($_SESSION['user'])) header('Location: index.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Profil</title>
</head>
<body>
    <div class="login-box user-box white">
        <p>Profil</p>
        <p>Nama:<br><br> <?= $_SESSION['user']['name'] ?><br><br></p>
        <p>Alamat:<br><br> <?= $_SESSION['user']['address'] ?><br><br></p>
        <p>Tanggal Lahir:<br><br> <?= $_SESSION['user']['birth_date'] ?><br><br></p>
        <p>No HP:<br><br> <?= $_SESSION['user']['phone_number'] ?><br><br></p>
        <p>Email: <br><br><?= $_SESSION['user']['email'] ?><br><br></p>
        <p>Grade:<br><br> <?= $_SESSION['user']['grade'] ?><br><br></p>
        <a href="edit.php">Edit Profil</a>
        <a href="change_grade.php">Ubah Grade</a>
        <a href="delete.php">Hapus Akun</a>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
