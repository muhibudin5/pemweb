<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: halaman_login.php"); // Redirect to the login page if not logged in
    exit();
}

$username = $_SESSION['username'];
$error = "";

// Handle account deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $file = 'users.txt';
    $users = file($file, FILE_IGNORE_NEW_LINES);
    $found = false;

    // Remove the user from the array
    foreach ($users as $key => $user) {
        list($stored_username, $stored_password) = explode(":", $user);
        if ($stored_username === $username) {
            unset($users[$key]);
            $found = true;
            break;
        }
    }

    // Save the updated users back to the file
    if ($found) {
        file_put_contents($file, implode("\n", $users));
        session_destroy(); // Destroy the session
        header("Location: halaman login.php"); // Redirect to login page after deletion
        exit();
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
    <title>Hapus Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Hapus Akun</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php else: ?>
            <div class="alert alert-warning">
                Apakah Anda yakin ingin menghapus akun Anda? Ini tidak dapat dibatalkan.
            </div>
            <form method="POST" action="">
                <button type="submit" name="delete" class="btn btn-danger">Hapus Akun</button>
                <a href="akun_terdaftar.php" class="btn btn-secondary">Kembali ke Daftar Akun</a>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
