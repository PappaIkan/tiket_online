<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require_once 'connection.php';

// Ambil username dari session
$username = $_SESSION['username'];

// Ambil data pemesanan beserta informasi pengguna dan jadwal
$query = "SELECT 
              booking.booking_id, 
              booking.jadwal_id, 
              booking.booking_date, 
              booking.booking_status, 
              booking.type_ticket_id, 
              booking.quantity, 
              booking.total_price,
              jadwal.jam_keberangkatan
          FROM booking
          JOIN users ON booking.user_id = users.id
          JOIN jadwal ON booking.jadwal_id = jadwal.id
          WHERE users.email = '$username'";
$history_result = mysqli_query($conn, $query);
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
            <th>Jam Keberangkatan</th>
            <th>Type Ticket ID</th>
            <th>Email Pengguna</th>
            <th>Quantity</th>
            <th>Total Harga</th>
            <th>Tanggal Pemesanan</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($history_result)): ?>
        <tr>
            <td><?= $row['booking_id']; ?></td>
            <td><?= $row['jam_keberangkatan']; ?></td>
            <td><?= $row['type_ticket_id']; ?></td>
            <td><?= $username; ?></td>
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
