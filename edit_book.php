<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require_once 'connection.php';

// Pastikan booking_id ada di query string
if (!isset($_GET['booking_id'])) {
    header("Location: history.php");
    exit;
}

$booking_id = $_GET['booking_id'];

// Ambil data booking yang akan diedit
$query = "SELECT * FROM booking WHERE booking_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

// Jika data tidak ditemukan, kembali ke halaman history
if (!$booking) {
    header("Location: history.php");
    exit;
}

// Ambil data harga tiket dari tabel type_ticket
$price_query = "SELECT id, price FROM type_ticket"; // Sesuaikan dengan kolom yang benar
$price_result = $conn->query($price_query);
$prices = [];
while ($row = $price_result->fetch_assoc()) {
    $prices[$row['id']] = $row['price']; // Sesuaikan dengan kolom yang benar
}

// Proses update data jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jadwal_id = $_POST['jadwal_id'];
    $type_ticket_id = $_POST['type_ticket_id'];
    $quantity = $_POST['quantity'];
    $booking_date = $_POST['booking_date'];

    // Hitung total harga berdasarkan harga tiket dan quantity
    if (isset($prices[$type_ticket_id])) {
        $total_price = $prices[$type_ticket_id] * $quantity;
    } else {
        echo "Type Ticket ID tidak valid.";
        exit;
    }

    $update_query = "UPDATE booking SET jadwal_id = ?, type_ticket_id = ?, quantity = ?, total_price = ?, booking_date = ? WHERE booking_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("iiidsi", $jadwal_id, $type_ticket_id, $quantity, $total_price, $booking_date, $booking_id);

    if ($stmt->execute()) {
        header("Location: history.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Pemesanan</title>
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
            max-width: 500px;
            margin: auto;
            padding: 20px;
            background-color: #191C24;
            border-radius: 5px;
        }

        h3 {
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
        }

        input[type="number"],
        input[type="date"],
        input[type="text"] {
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            background-color: #0F1015;
            color: white;
        }

        input[readonly] {
            background-color: #0F1015;
        }

        input[type="submit"] {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4F5775;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #333;
        }
    </style>
</head>

<body>
    <div class="sidenav">
        <div class="title">Welcome to Tiket Online</div>
        <a href="index.php">Home</a>
        <a href="pesan.php">Pesan tiket</a>
        <a href="history.php">History</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="main">
        <div class="container">
            <h3>Edit Pemesanan</h3>
            <form method="post">
                <label for="jadwal_id">Jadwal ID:</label>
                <input type="text" name="jadwal_id" value="<?= $booking['jadwal_id']; ?>" readonly>

                <label for="type_ticket_id">Type Ticket ID:</label>
                <input type="text" name="type_ticket_id" value="<?= $booking['type_ticket_id']; ?>" readonly>

                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" value="<?= $booking['quantity']; ?>" required>

                <label for="total_price">Total Harga:</label>
                <input type="number" name="total_price" value="<?= $prices[$booking['type_ticket_id']] * $booking['quantity']; ?>" readonly>

                <label for="booking_date">Tanggal Pemesanan:</label>
                <input type="date" name="booking_date" value="<?= $booking['booking_date']; ?>" required>

                <input type="submit" value="Update">
            </form>
        </div>
    </div>
</body>

</html>
