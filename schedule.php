<?php
    require_once 'connection.php';

    $jadwal_result = mysqli_query($conn,"SELECT * FROM jadwal");
    $ticket_result = mysqli_query($conn,"SELECT * FROM type_ticket");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <style>
        body{
            margin: 0;
            padding: 0;
            font-family:Arial, Helvetica, sans-serif;
        }      
        .sidenav{
            height: 100%;
            width: 170px;
            position: fixed; /* Fixed Sidebar (stay in place on scroll) */
            z-index: 1; /* Stay on top */
            top: 0; /* Stay at the top */
            left: 0;
            background-color: #111; /* Black */
            overflow-x: hidden; /* Disable horizontal scroll */
            padding-top: 20px;
        }
        .sidenav a{
            padding: 30px 8px 30px 16px;
            text-decoration: none;
            font-size: 30px;
            color: #818181;
            display: block;
        }
        .title{
            padding: 30px 8px 30px 16px;
            font-size: 30px;
            display: block;
            color: red;
        }
        .sidenav a:hover{
            color: #f1f1f1;
        }
        .main {
            margin-left: 160px;
            padding: 0px 10px;
        }
        @media screen and (max-height:450px) {
            .sidenav {padding-top: 450px;}
            .sidenav a {font-size: 18px;}
        }
        .container{
            margin-left: 170px;
            padding: 1px 16px;
            height: 1000px;
        }
    </style>
</head>
<body>
    <div class="sidenav">
        <div class="title">Admin</div>
        <a href="admin.php">Dashboard</a>
        <a href="schedule.php">Schedule</a>
        <a href="client.php">Client</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="container">
        <div class="">Schedule</div>
        <table>
            <tr>
                <td>City</td>
                <td>Time</td>
                <td>Action</td>
            </tr>
            <?php while($row = mysqli_fetch_array($jadwal_result)){
            ?>
            <tr>
                <td><?= $row['city']; ?></td>
                <td><?= $row['jam_keberangkatan']; ?></td>
                <td><a href="edit.php?id=<?=$row['id'];?>">Edit</a> <a href="delete.php?id=<?=$row['id'];?>">delete</a></td>
            </tr>
            <?php
            }
        ?>  
        </table>
        <div>Ticket</div>
        <table>
            <tr>
                <td>Class</td>
                <td>Price</td>
                <td>Action</td>
            </tr>
            <?php while($row = mysqli_fetch_array($ticket_result)){
            ?>
            <tr>
                <td><?= $row['class']; ?></td>
                <td>Rp. <?= $row['price']; ?></td>
                <td><a href="edit.php?id=<?=$row['id'];?>">Edit</a> <a href="delete.php?id=<?=$row['id'];?>">delete</a></td>
            </tr>
            <?php
            }
        ?>  
        </table>
    </div>
</body>
</html>