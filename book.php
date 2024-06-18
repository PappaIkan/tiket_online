<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jadwal_id = $_POST['jadwal_id'];
    $type_ticket_id = $_POST['type_ticket_id'];
    $quantity = $_POST['quantity'];
    $user_email = $_SESSION['username'];

    // Ambil harga tiket
    $ticket_result = mysqli_query($conn, "SELECT price FROM type_ticket WHERE id=$type_ticket_id");
    if ($ticket_result) {
        $ticket = mysqli_fetch_assoc($ticket_result);
        $price = $ticket['price'];

        // Hitung total harga
        $total_price = $price * $quantity;

        // Insert ke tabel booking
        $query = "INSERT INTO booking (jadwal_id, type_ticket_id, users_email, quantity, total_price) VALUES ($jadwal_id, $type_ticket_id, '$user_email', $quantity, $total_price)";
        if (mysqli_query($conn, $query)) {
            header("Location: history.php");
            exit;
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: Could not retrieve ticket price.";
    }
}
?>