<?php
include('db.php'); 
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php'); 
    exit;
}

$user_id = $_SESSION['user']['id'];

if (isset($_POST['delete_account'])) {
    $query = "DELETE FROM users WHERE id = $user_id";

    if (mysqli_query($conn, $query)) {
        session_destroy();
        header('Location: index.php?message=account_deleted');
        exit;
    } else {
        $error_message = "Terjadi kesalahan: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Hapus Akun</title>
</head>
<body>
<div class="login-box user-box white">
    <h2>Hapus Akun</h2>
    <p>Apakah Anda yakin ingin menghapus akun Anda? Tindakan ini tidak dapat dibatalkan.</p>

    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?= $error_message ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <button type="submit" name="delete_account" style="background-color: red; color: white;">Hapus Akun</button>
        <a href="profile.php" style="margin-left: 10px;">Batal</a>
    </form>
</div>
</body>
</html>
