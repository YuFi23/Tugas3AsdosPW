<?php
include('db.php'); 
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$user_id = $_SESSION['user']['id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if (isset($_POST['update_account'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $birth_date = mysqli_real_escape_string($conn, $_POST['birth_date']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password']; 

    $query = "UPDATE users SET 
                name = '$name', 
                address = '$address', 
                birth_date = '$birth_date', 
                phone_number = '$phone_number', 
                email = '$email', 
                password = '$password' 
              WHERE id = $user_id";

    if (mysqli_query($conn, $query)) {
        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['address'] = $address;
        $_SESSION['user']['birth_date'] = $birth_date;
        $_SESSION['user']['phone_number'] = $phone_number;
        $_SESSION['user']['email'] = $email;

        $success_message = "Data akun berhasil diperbarui.";
    } else {
        $error_message = "Terjadi kesalahan: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Edit Akun</title>
</head>
<body>
    


    <div class="login-box user-box white">
        <p>Edit Akun</p>
    <form method="POST" action="">
        <label for="name">Nama:</label><br>
        <input type="text" name="name" id="name" value="<?= $user['name'] ?>" required><br><br>

        <label for="address">Alamat:</label><br>
        <textarea name="address" id="address" required><?= $user['address'] ?></textarea><br><br>

        <label for="birth_date">Tanggal Lahir:</label><br>
        <input type="date" name="birth_date" id="birth_date" value="<?= $user['birth_date'] ?>" required><br><br>

        <label for="phone_number">No HP:</label><br>
        <input type="text" name="phone_number" id="phone_number" value="<?= $user['phone_number'] ?>" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" value="<?= $user['email'] ?>" required><br><br>

        <label for="password">Password Baru (Opsional):</label><br>
        <input type="password" name="password" id="password" placeholder="Kosongkan jika tidak ingin mengubah password"><br><br>

        <button type="submit" name="update_account">Simpan Perubahan</button>
    </form>
    <?php if (isset($success_message)): ?>
        <p style="color: green;"><?= $success_message ?></p>
    <?php endif; ?>
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?= $error_message ?></p>
    <?php endif; ?>
    <br>
    <a href="profile.php">Kembali ke Profil</a>
    </div>
</body>
</html>
