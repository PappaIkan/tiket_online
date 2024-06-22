<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require_once 'connection.php';

// Pastikan user_id ada di session
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

// Ambil user_id dari session
$user_id = $_SESSION['id'];

// Query SQL untuk mengambil riwayat pemesanan berdasarkan user_id
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
          JOIN jadwal ON booking.jadwal_id = jadwal.id
          WHERE booking.user_id = ?";

// Prepare statement
$stmt = $conn->prepare($query);

// Bind parameter (gunakan 'i' karena user_id adalah integer)
$stmt->bind_param("i", $user_id);

// Execute statement
$stmt->execute();

// Get result
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Riwayat Pemesanan</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h3>Riwayat Pemesanan</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Jadwal ID</th>
            <th>Jam Keberangkatan</th>
            <th>Type Ticket ID</th>
            <th>Email Pengguna</th>
            <th>Quantity</th>
            <th>Total Harga</th>
            <th>Tanggal Pemesanan</th>
            <th>HAPUS</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['booking_id']; ?></td>
            <td><?= $row['jadwal_id']; ?></td>
            <td><?= $row['jam_keberangkatan']; ?></td>
            <td><?= $row['type_ticket_id']; ?></td>
            <td><?= $_SESSION['email']; ?></td>
            <td><?= $row['quantity']; ?></td>
            <td><?= $row['total_price']; ?></td>
            <td><?= $row['booking_date']; ?></td>
            <td><a href="hapus.php?booking_id=<?= $row['booking_id']; ?>">hapus</a>
        </tr>
        <?php endwhile; ?>
    </table>
    <p><a href="index.php">Kembali ke Halaman Utama</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>

</html>
