<?php
// session_start();

// // Periksa apakah pengguna sudah login dan apakah role adalah admin
// if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
//     header("Location: login.php"); // Arahkan ke halaman login jika belum login atau bukan admin
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
        .card-content-top{
            display: flex;
            justify-content: space-around;
            text-align: center;
            
            
            
        }
        .card-view,.card-sale,.card-order{
            border-radius: 10px;
            background-color: palegreen;
            padding: 10px;
        }

        .card-content-title{
        }
        .content-viewer{
            display: grid;
            grid-template-columns: auto auto;
            
        }
        .content-viewer-account{
            /* border-bottom: 2px solid black; */
        }
    </style>
</head>
<body>
    <!-- <h1>Selamat datang di Halaman Admin</h1>
    <p>Ini adalah halaman admin yang hanya bisa diakses oleh admin setelah login.</p> -->
    <div class="sidenav">
        <div class="title">Admin</div>
        <a href="admin.php">Dashboard</a>
        <a href="schedule.php">Schedule</a>
        <a href="client.php">Client</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="container">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id ad qui animi ducimus quam alias a quisquam blanditiis totam, eveniet soluta dolorem ipsam hic numquam, deserunt quaerat! Odio, dolor facere?
        <div class="card-content-top">
            <div class="card-view">
                <div class="card-content-title">view</div>
                <div></div>
            </div>
            <div class="card-sale">
                <div class="card-content-title">sale</div>
                <div></div>
            </div>
            <div class="card-order">
                <div class="card-content-title">order</div>
                <div></div>
            </div>
        </div>
        <div class="content-viewer">
            <div class="content-viewer-account">
                Member View
            
            </div>
            <div class="content">
                Member buy
            </div>
        </div>
        
    </div>
    
</body>
</html>
