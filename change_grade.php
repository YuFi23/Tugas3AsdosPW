<?php
include('db.php'); 
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php'); 
    exit;
}

$user_id = $_SESSION['user']['id'];
$current_grade = $_SESSION['user']['grade'];

if (isset($_POST['change_grade'])) {
    $new_grade = $_POST['new_grade']; 
    if ($new_grade !== $current_grade) {
        $query = "UPDATE users SET grade = '$new_grade' WHERE id = $user_id";
        if (mysqli_query($conn, $query)) {
            $_SESSION['user']['grade'] = $new_grade;
            $success_message = "Grade berhasil diubah menjadi $new_grade.";
        } else {
            $error_message = "Terjadi kesalahan: " . mysqli_error($conn);
        }
    } else {
        $error_message = "Grade baru harus berbeda dari grade saat ini.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Ubah Grade</title>
</head>
<body>
    <div class="login-box user-box white">
    <h2>Ubah Grade</h2>
    <p>Grade saat ini: <strong><?= $current_grade ?></strong></p>


    <form method="POST" action="">
        <label for="new_grade">Pilih Grade Baru:</label><br>
        <select name="new_grade" id="new_grade" required>
            <option value="" disabled selected>-- Pilih Grade --</option>
            <option value="A" <?= $current_grade == 'A' ? 'disabled' : '' ?>>Grade A</option>
            <option value="B" <?= $current_grade == 'B' ? 'disabled' : '' ?>>Grade B</option>
            <option value="C" <?= $current_grade == 'C' ? 'disabled' : '' ?>>Grade C</option>
        </select><br><br>
        <button type="submit" name="change_grade">Ubah Grade</button>
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
