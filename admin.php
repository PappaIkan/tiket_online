<?php
session_start();

// Periksa apakah pengguna sudah login dan apakah role adalah admin
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php"); // Arahkan ke halaman login jika belum login atau bukan admin
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halaman Admin</title>
</head>
<body>
    <h1>Selamat datang di Halaman Admin</h1>
    <p>Ini adalah halaman admin yang hanya bisa diakses oleh admin setelah login.</p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
