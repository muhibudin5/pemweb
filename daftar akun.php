<?php
session_start();
$success = "";
$error = "";

// Check if the registration form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate password and confirmation
    if ($password !== $confirm_password) {
        $error = "Password dan konfirmasi password tidak cocok!";
    } else {
        $file = 'users.txt';

        // Check if the file exists
        if (!file_exists($file)) {
            file_put_contents($file, ""); // Create file if it doesn't exist
        }

        // Read existing data
        $existing_users = file($file, FILE_IGNORE_NEW_LINES);

        // Check if the username already exists
        $is_existing_user = false;
        foreach ($existing_users as $user) {
            list($existing_username, $existing_password) = explode(":", $user);
            if ($existing_username == $username) {
                $is_existing_user = true;
                break;
            }
        }

        if ($is_existing_user) {
            $error = "Username sudah terdaftar. Gunakan username lain.";
        } else {
            // Save new username and password to the file
            $data = $username . ":" . $password . "\n";
            file_put_contents($file, $data, FILE_APPEND);

            // Set success message and redirect to login after 2 seconds
            $success = "Pendaftaran berhasil! Silakan login.";
            header("refresh:2; url=halaman login.php"); // Redirect after 2 seconds
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .register-container {
      margin-top: 100px;
    }
  </style>
</head>
<body>
  <div class="container register-container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <h2 class="text-center">Daftar Akun</h2>
        <form method="POST" action="">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="mb-3">
            <label for="confirm_password" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Daftar</button>
        </form>

        <!-- Success message -->
        <?php if ($success): ?>
          <div class="alert alert-success mt-3">
            <?php echo $success; ?>
          </div>
        <?php endif; ?>

        <!-- Error message -->
        <?php if ($error): ?>
          <div class="alert alert-danger mt-3">
            <?php echo $error; ?>
          </div>
        <?php endif; ?>

        <!-- Button to go back to login -->
        <div class="text-center mt-3">
          <p>Sudah punya akun? <a href="halaman login.php" class="btn btn-secondary">Kembali ke Login</a></p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
