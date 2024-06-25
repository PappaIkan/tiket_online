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
    <meta charset="UTF-8">
    <title>Halaman <?= htmlspecialchars($username); ?></title>
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
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #191C24;
            border-radius: 5px;
        }

        h4 {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        select,
        input[type="number"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: none;
            background-color: #0F1015;
            color: white;
            font-size: 16px;
        }

        button {
            background-color: #4F5775;
            cursor: pointer;
        }

        button:hover {
            background-color: #333;
        }
    </style>
</head>

<body>
    <div class="sidenav">
        <div class="title">Welcome to Tiket Online</div>
        <a href="index.php">Home</a>
        <a href="pesan.php" class="active">Pesan tiket</a>
        <a href="history.php">History</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="main">
        <div class="container">
            <h4>Pesan Tiket</h4>
            <form action="book.php" method="post">
                <label for="jadwal_id">Pilih Jadwal Keberangkatan:</label>
                <select name="jadwal_id" id="jadwal_id" required>
                    <?php mysqli_data_seek($jadwal_result, 0); // Reset cursor to beginning ?>
                    <?php while ($row = mysqli_fetch_assoc($jadwal_result)): ?>
                        <option value="<?= $row['id']; ?>"><?= $row['city']; ?> - <?= date('H:i',strtotime($row['jam_keberangkatan'])); ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="type_ticket_id">Pilih Jenis Tiket:</label>
                <select name="type_ticket_id" id="type_ticket_id" required>
                    <?php mysqli_data_seek($type_ticket_result, 0); // Reset cursor to beginning ?>
                    <?php while ($row = mysqli_fetch_assoc($type_ticket_result)): ?>
                        <option value="<?= $row['id']; ?>"><?= $row['class']; ?> - Rp.<?= number_format($row['price']); ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="quantity">Jumlah Tiket:</label>
                <input type="number" name="quantity" id="quantity" required>

                <button type="submit">Pesan</button>
            </form>
        </div>
    </div>
</body>

</html>
