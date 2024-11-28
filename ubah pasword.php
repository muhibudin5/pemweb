<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: akun_terdaftar.php"); // Redirect if not logged in
    exit();
}

$error = "";
$username = $_SESSION['username'];

// Handle password change request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Load users
    $file = 'users.txt';
    $users = file($file, FILE_IGNORE_NEW_LINES);
    $found = false;

    foreach ($users as &$user) {
        list($stored_username, $stored_password) = explode(":", $user);
        if ($stored_username === $username) {
            $found = true;
            // Validate old password
            if ($stored_password === $old_password) {
                // Update password
                $user = "$stored_username:$new_password";
                $error = "Kata sandi berhasil diubah.";
            } else {
                $error = "Kata sandi lama salah.";
            }
            break;
        }
    }

    // Save updated users
    if ($found) {
        file_put_contents($file, implode("\n", $users));
    } else {
        $error = "Akun tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Kata Sandi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Ubah Kata Sandi</h2>
        <?php if ($error): ?>
            <div class="alert alert-warning"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="old_password" class="form-label">Kata Sandi Lama</label>
                <input type="password" class="form-control" id="old_password" name="old_password" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">Kata Sandi Baru</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Ubah Kata Sandi</button>
            <a href="akun terdaftar.php" class="btn btn-secondary">Kembali ke Daftar Akun</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
