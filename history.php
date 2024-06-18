<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require_once 'connection.php';

// Ambil username dari session
$username = $_SESSION['username'];

// Ambil data pemesanan
$history_result = mysqli_query($conn, "SELECT * FROM booking WHERE users_email='$username'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Riwayat Pemesanan</title>
</head>

<body>
    <h3>Riwayat Pemesanan <?= htmlspecialchars($username); ?></h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Jadwal ID</th>
            <th>Type Ticket ID</th>
            <th>Email Pengguna</th>
            <th>Quantity</th>
            <th>Total Harga</th>
            <th>Tanggal Pemesanan</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($history_result)): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['jadwal_id']; ?></td>
            <td><?= $row['type_ticket_id']; ?></td>
            <td><?= $row['users_email']; ?></td>
            <td><?= $row['quantity']; ?></td>
            <td><?= $row['total_price']; ?></td>
            <td><?= $row['booking_date']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <p><a href="index.php">Kembali ke Halaman Utama</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>

</html>
