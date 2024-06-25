<?php
    require_once "connection.php";
    $id = $_GET['id'];
    mysqli_query($conn,"DELETE FROM users WHERE id = '$id'");
    header("Location:admin_client.php");
?>