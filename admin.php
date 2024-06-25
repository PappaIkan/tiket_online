<?php
session_start();

// Periksa apakah pengguna sudah login dan apakah role adalah admin
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php"); // Arahkan ke halaman login jika belum login atau bukan admin
    exit;
}
require_once 'connection.php';
$sale_result = mysqli_query($conn, "SELECT SUM(total_price) AS total_price FROM booking");
$booking_result = mysqli_query($conn, "SELECT SUM(quantity) AS total_book FROM booking");
$user_booking_result = mysqli_query($conn, "SELECT * FROM booking JOIN users ON users.id = booking.user_id JOIN type_ticket ON type_ticket.id = booking.type_ticket_id JOIN jadwal ON jadwal.id = booking.jadwal_id;");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: black;

        }

        .sidenav {
            height: 100%;
            width: 170px;
            position: fixed;
            /* Fixed Sidebar (stay in place on scroll) */
            z-index: 1;
            /* Stay on top */
            top: 0;
            /* Stay at the top */
            left: 0;
            background-color: #191C24;
            overflow-x: hidden;
            /* Disable horizontal scroll */
            padding-top: 20px;
        }

        .sidenav a {
            margin: 30px 30px 30px 10px;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 15px;
            color: #4F5775;
            display: block;

        }

        .title {
            padding: 30px 8px 30px 16px;
            font-size: 30px;
            display: block;
            color: white;


        }

        .sidenav a:hover {
            color: white;
            background-color: #0F1015;
            transition: 0.5s;
        }

        .sidenav a.active {
            border-radius: 5px;
            color: white;
            background-color: #0F1015;
        }

        .main {
            margin-left: 160px;
            padding: 0px 10px;
        }

        @media screen and (max-height:450px) {
            .sidenav {
                padding-top: 450px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }

        .container {
            margin-left: 170px;
            padding: 1px 16px;
            color: white;
        }

        .card-content-top {
            display: flex;
            justify-content: space-around;
            text-align: center;
        }

        .card-view,
        .card-sale,
        .card-order {
            border-radius: 5px;
            background-color: #191C24;
            margin: 25px;
            padding: 10px;
        }

        .content-viewer {
            justify-content: center;
        }

        .card-table {
            text-align: center;
            background-color: #191C24;
            border-radius: 5px;
            padding: 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
            border-radius: 5px;
            overflow: hidden;
        }
        table,th,td {
            padding: 12px;
            text-align: center;
        }

        .top-table {
            background-color: #0F1015;
        }
    </style>
</head>

<body>
    <div class="sidenav">
        <div class="title">Welcome Admin :v</div>
        <a href="admin.php" class="active">Dashboard</a>
        <a href="admin_schedule.php">Schedule</a>
        <a href="admin_client.php">Client</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="container">
        <div class="title">Dashboard</div>
        <div class="card-content-top">
            <div class="card-sale">
                <div class="card-content-title">Sale</div>
                <?php
                while ($row = mysqli_fetch_array($sale_result)) {
                    ?>
                    <div>Rp.<?= number_format($row['total_price']); ?></div>

                    <?php
                }
                ?>
                <div></div>
            </div>
            <div class="card-order">
                <div class="card-content-title">order</div>
                <?php
                while ($row = mysqli_fetch_array($booking_result)) {
                    ?>
                    <div><?= $row['total_book']; ?></div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="content-viewer">
            <div class="title">Member Booking</div>
            <div class="card-table">
                <table>
                    <tr>
                        <td class="top-table" style="border-top-left-radius: 5px; border-bottom-left-radius:5px;">Name
                        </td>
                        <td class="top-table">Email</td>
                        <td class="top-table">Class</td>
                        <td class="top-table">Schedule</td>
                        <td class="top-table">Booking Date</td>
                        <td class="top-table">Booking Status</td>
                        <td class="top-table">Quantity</td>
                        <td class="top-table" style="border-top-right-radius: 5px; border-bottom-right-radius:5px;">
                            Total Price</td>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_array($user_booking_result)) {
                        ?>
                        <tr>
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td><?= $row['class']; ?></td>
                            <td><?= $row['city'], " ", date('H:i',strtotime($row['jam_keberangkatan'])); ?></td>
                            <td><?= $row['booking_date']; ?></td>
                            <td><?= $row['booking_status']; ?></td>
                            <td><?= $row['quantity']; ?></td>
                            <td>Rp.<?= number_format($row['total_price']); ?></td>
                        </tr>
                        <?php
                    }
                    ?>

                </table>
            </div>
        </div>

    </div>

</body>

</html>