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
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: black;
            color: white;
        }

        .sidenav {
            height: 100%;
            width: 200px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #191C24;
            overflow-x: hidden;
            padding-top: 20px;
        }

        .sidenav a {
            margin: 20px 0;
            padding: 15px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            color: #4F5775;
            display: block;
        }

        .sidenav a:hover,
        .sidenav a.active {
            color: white;
            background-color: #0F1015;
            transition: 0.5s;
        }

        .title {
            padding: 20px;
            font-size: 24px;
            text-align: center;
            color: white;
        }

        .main {
            margin-left: 200px;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 20px;
            background-color: #191C24;
            border-radius: 5px;
        }

        h3 {
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            border-collapse: separate;
            width: 100%;
            margin-bottom: 20px;
            border-radius: 5px;
            overflow: hidden;
        }

        table,th,td {
            border: 1px solid #4F5775;
            padding: 12px;
            text-align: center;
            background-color: #0F1015;
        }

        th {
            background-color: #4F5775;
        }

        a {
            color: #4F5775;
            text-decoration: none;
            transition: color 0.3s;
        }

        a:hover {
            color: white;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            border-radius: 5px;
            background-color: #4F5775;
            color: white;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #333;
        }
    </style>
</head>

<body>
    <div class="sidenav">
        <div class="title">Welcome to Tiket Online</div>
        <a href="index.php">Home</a>
        <a href="pesan.php">Pesan tiket</a>
        <a href="history.php" class="active">History</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="main">
        <div class="container">
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
                        <td><a href="hapus.php?booking_id=<?= $row['booking_id']; ?>" >hapus</a></td>
                    </tr>
                <?php endwhile; ?>
            </table>
            <a href="index.php" class="button">Kembali ke Halaman Utama</a>
            <a href="logout.php" class="button">Logout</a>
        </div>
    </div>
</body>

</html>