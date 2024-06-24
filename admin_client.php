<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php"); // Arahkan ke halaman login jika belum login atau bukan admin
    exit;
}
    require_once 'connection.php';

    $user_result = mysqli_query($conn,"SELECT * FROM users WHERE role = 'user'");
    
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
            background-color: black;
            
        }      
        .sidenav{
            height: 100%;
            width: 170px;
            position: fixed;
            z-index: 1; 
            top: 0; 
            left: 0;
            background-color: #191C24;
            overflow-x: hidden;
            padding-top: 20px;
        }
        .sidenav a{
            margin: 30px 30px 30px 10px;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 15px;
            color:#4F5775;
            display: block;
            transition: 0.5s;
        }
        .title{
            padding: 30px 8px 30px 16px;
            font-size: 30px;
            display: block;
            color: white;
            

        }
        .sidenav a:hover{
            color: white;
            background-color: #0F1015;
            
        }
        .sidenav a.active{
            border-radius: 5px;
            color: white;
            background-color: #0F1015;
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
            color: white;
        }
        .card-table{
            border-radius: 5px;
            background-color: #191C24;
            padding: 20px;
        }
        table{
            justify-content: center;
            width: 100%;     
            height: 100px;      
            border-collapse:collapse;
            
        }
        .top-table{
            background-color: #0F1015;
            padding: 1px;
        }
        .delete{
            text-decoration: none;
            border-radius: 5px;
            background-color: red;
            padding: 10px;
            color: white;
        }

        td{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="sidenav">
        <div class="title">Welcome Admin :v</div>
        <a href="admin.php">Dashboard</a>
        <a href="admin_schedule.php">Schedule</a>
        <a href="admin_client.php" class="active">Client</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="container">
        <div class="title">Member</div>
        <div class="card-table">
            <table>
                <tr>
                    <td class="top-table" style="border-top-left-radius: 5px; border-bottom-left-radius:5px;">Name</td>
                    <td class="top-table">Account</td>
                    <td class="top-table" style="border-top-right-radius: 5px; border-bottom-right-radius:5px;">Action</td>
                </tr>
                <?php
                    while($row=mysqli_fetch_array($user_result)){
                    ?>
                <tr>
                    <td><?=$row['name'];?></td>
                    <td><?=$row['email'];?></td>
                    <td><a class="delete" href="operations/delete.php?=id<?=$row['id'];?>">Delete</a></td>
                </tr>

                <?php
                }
                ?>
            
            </table>
        </div>

    </div>
</body>
</html>