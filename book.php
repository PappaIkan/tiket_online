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
    
    // Validasi nilai dari $_SESSION['username'] (harus berupa email)
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        echo "Error: Invalid email format.";
        exit;
    }
    // Ambil harga tiket
    $ticket_result = mysqli_query($conn, "SELECT price FROM type_ticket WHERE id=$type_ticket_id");
    if ($ticket_result) {
        $ticket = mysqli_fetch_assoc($ticket_result);
        $price = $ticket['price'];

        // Hitung total harga
        $total_price = $price * $quantity;
        
        // Ambil user_id berdasarkan email
        $user_query = "SELECT id FROM users WHERE email='$user_email'";
        $user_result = mysqli_query($conn, $user_query);
        if ($user_result && mysqli_num_rows($user_result) > 0) {
            $user = mysqli_fetch_assoc($user_result);
            $user_id = $user['id'];

            // Insert ke tabel booking
            $query = "INSERT INTO booking (user_id, jadwal_id, type_ticket_id, quantity, total_price, booking_date, booking_status) 
                      VALUES ($user_id, $jadwal_id, $type_ticket_id, $quantity, $total_price, NOW(), 'Pending')";

            if (mysqli_query($conn, $query)) {
                $booking_id = mysqli_insert_id($conn);
                header("Location: history.php");
                exit;
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Error: User not found for email '$user_email'.";
        }
    } else {
        echo "Error: Could not retrieve ticket price.";
    }
}
?>
