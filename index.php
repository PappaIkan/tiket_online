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
            transition: 0.5s;
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
            transition: margin-left 0.5s;
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

        .toggle-btn {
            position: absolute;
            top: 20px;
            left: 220px;
            font-size: 30px;
            cursor: pointer;
            color: white;
            z-index: 2;
        }

    </style>
</head>

<body>
    <div class="sidenav" id="sidenav">
        <div class="title">Welcome to Tiket Online</div>
        <a href="index.php" class="active">Home</a>
        <a href="pesan.php">Pesan tiket</a>
        <a href="history.php">Riwayat Pemesanan</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="main" id="mainContent">
        <div class="container">
            <div class="title">Dashboard</div>
            <h4>Jadwal Keberangkatan</h4>
            <div class="card-table">
                <table>
                    <tr>
                        <th>Kota</th>
                        <th>Jam Keberangkatan</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($jadwal_result)): ?>
                        <tr>
                            <td><?= $row['city']; ?></td>
                            <td><?= date('H:i',strtotime($row['jam_keberangkatan'])); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            <h4>Jenis Tiket</h4>
            <div class="card-table">
                <table>
                    <tr>
                        <th>Kelas</th>
                        <th>Harga</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($type_ticket_result)): ?>
                        <tr>
                            <td><?= $row['class']; ?></td>
                            <td>Rp.<?=number_format($row['price']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
