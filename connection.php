<?php
// Create connection
$conn = mysqli_connect('localhost','root','','db_ticket_online');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>