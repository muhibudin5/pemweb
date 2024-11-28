<?php
session_start();
$error = "";

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Read the users.txt file to validate the account
    $file = 'users.txt';
    if (file_exists($file)) {
        $existing_users = file($file, FILE_IGNORE_NEW_LINES);
        $valid_user = false;

        // Loop to check if the username and password match
        foreach ($existing_users as $user) {
            list($stored_username, $stored_password) = explode(":", $user);
            if ($stored_username === $username && $stored_password === $password) {
                $valid_user = true;
                break;
            }
        }

        // If login is successful
        if ($valid_user) {
            $_SESSION['username'] = $username; // Store the username in session
            header("Location: profil.php"); // Redirect to the profile page after login
            exit();
        } else {
            $error = "ID atau Password salah!";
        }
    } else {
        $error = "Belum ada akun terdaftar!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Dulu Men!!!</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .login-container {
      margin-top: 100px;
    }
  </style>
</head>
<body>
  <div class="container login-container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <h2 class="text-center">Login Dulu Men!!!</h2>
        <form method="POST" action="">
          <div class="mb-3">
            <label for="username" class="form-label">ID Admin</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>

        <!-- Error message if credentials are wrong -->
        <?php if ($error): ?>
          <div class="alert alert-danger mt-3">
            <?php echo $error; ?>
          </div>
        <?php endif; ?>

        <!-- Registration Button -->
        <div class="text-center mt-3">
          <p>Belum punya akun? <a href="daftar akun.php" class="btn btn-secondary">Daftar Akun</a></p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
