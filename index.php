<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require_once 'connection.php';

// Ambil username dari session
$username = $_SESSION['username'];

// Ambil data jadwal
$jadwal_result = mysqli_query($conn, "SELECT * FROM jadwal");

// Ambil data type_ticket
$type_ticket_result = mysqli_query($conn, "SELECT * FROM type_ticket");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Halaman <?= htmlspecialchars($username); ?></title>
</head>

<body>
    <h3>Selamat datang, <?= htmlspecialchars($username); ?>!</h3>
    <h4>Jadwal Keberangkatan</h4>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Kota</th>
            <th>Jam Keberangkatan</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($jadwal_result)): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['city']; ?></td>
            <td><?= $row['jam_keberangkatan']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <h4>Jenis Tiket</h4>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Kelas</th>
            <th>Harga</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($type_ticket_result)): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['class']; ?></td>
            <td><?= $row['price']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h4>Pesan Tiket</h4>
    <form action="book.php" method="post">
        <label for="jadwal_id">Jadwal ID:</label>
        <input type="number" name="jadwal_id" id="jadwal_id" required><br>

        <label for="type_ticket_id">Type Ticket ID:</label>
        <input type="number" name="type_ticket_id" id="type_ticket_id" required><br>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" required><br>

        <button type="submit">Pesan</button>
    </form>

    <p><a href="history.php">Riwayat Pemesanan</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>

</html>