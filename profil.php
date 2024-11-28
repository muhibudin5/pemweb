<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: halaman login.php"); // Redirect to the login page if not logged in
    exit();
}

$error = ""; // Placeholder for potential error messages
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .btn-timbul {
      background-color: #24292e; /* GitHub button color */
      color: white;
    }
    .btn-timbul:hover {
      background-color: #3b5998; /* GitHub button hover color */
    }
    .btn-wa {
      background-color: #25d366; /* WhatsApp button color */
      color: white;
    }
    .btn-wa:hover {
      background-color: #128c7e; /* WhatsApp button hover color */
    }
  </style>
</head>
<body>
  <!-- Bagian Header -->
  <header class="bg-primary text-white text-center py-4">
    <div class="container">
      <h1>About Me</h1>
    </div>
  </header>

  <!-- Bagian Profil Anggota -->
  <section id="team" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Profil Tentang Saya</h2>
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img src="foto dimas.jpg" class="card-img-top" alt="Anggota" style="height: 300px; object-fit: cover;">
            <div class="card-body">
              <h5 class="card-title">Dimas Andika Lismani</h5>
              <p class="card-text">Saya Mahasiswa Teknik Informatika Universitas Buana Perjuangan, Saya Berpengalaman Dalam Ilmu Komputer.</p>
              <div class="d-flex justify-content-center btn-container">
                <a href="https://github.com/If23-DimasAL" class="btn btn-timbul">GitHub</a>
                <a href="https://wa.me/62882000619799" class="btn btn-wa">Kontak WhatsApp</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Form Logout -->
  <section class="py-5 text-center">
    <div class="container">
      <form method="post" action="logout.php"> <!-- Create a logout.php file to handle logout -->
        <button type="submit" name="logout" class="btn btn-danger btn-lg">Log Out</button>
      </form>
      <a href="akun terdaftar.php" class="btn btn-primary btn-lg mt-3">Daftar Akun Terdaftar</a> <!-- Link to registered users page -->
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3">
    <div class="container">
      <p>&copy; 2024 Tugas Penweb Teori. Semua hak dilindungi.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
