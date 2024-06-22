<?php
require_once 'connection.php';
$id = $_GET['booking_id'];
mysqli_query($conn, "DELETE FROM booking WHERE booking_id='$id'");
header("Location: history.php");
?>