<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: halaman_login.php"); // Redirect to the login page if not logged in
    exit();
}

// Load the registered users from users.txt
$users = [];
$file = 'users.txt';
if (file_exists($file)) {
    $existing_users = file($file, FILE_IGNORE_NEW_LINES);
    foreach ($existing_users as $user) {
        list($stored_username, $stored_password) = explode(":", $user);
        $users[] = $stored_username; // Store only usernames
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Terdaftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <header class="bg-primary text-white text-center py-4">
        <div class="container">
            <h1>Daftar Akun Terdaftar</h1>
        </div>
    </header>

    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Akun yang Terdaftar</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($users) > 0): ?>
                            <?php foreach ($users as $index => $username): ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo htmlspecialchars($username); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2" class="text-center">Tidak ada akun terdaftar.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="py-5 text-center">
        <div class="container">
            <h3>Pengaturan Akun</h3>
            <a href="ubah pasword.php" class="btn btn-warning btn-lg">Ubah Kata Sandi</a>
            <a href="hapus akun.php" class="btn btn-danger btn-lg">Hapus Akun</a>
        </div>
    </section>

    <section class="py-5 text-center">
        <div class="container">
            <form method="post" action="logout.php">
                <button type="submit" name="logout" class="btn btn-danger btn-lg">Log Out</button>
            </form>
        </div>
    </section>

    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p>&copy; 2024 Tugas Penweb Teori. Semua hak dilindungi.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
