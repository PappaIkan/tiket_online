<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Online</title>
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
            position: fixed; /* Fixed Sidebar (stay in place on scroll) */
            z-index: 1; /* Stay on top */
            top: 0; /* Stay at the top */
            left: 0;
            background-color: #191C24;
            overflow-x: hidden; /* Disable horizontal scroll */
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
        @media screen and (max-height:450px) {
            .sidenav {padding-top: 450px;}
            .sidenav a {font-size: 18px;}
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
        form {
            display: flex;
            justify-content: center;
        }
        input[type="text"] {
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            background-color: #0F1015;
            color: white;
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
        h3 {
            margin-bottom: 20px;
            text-align: center;
            color: white;
        }
    </style>
</head>
<body>
    <div class="sidenav">
        <div class="title">Welcome Admin</div>
        <a href="admin.php">Dashboard</a>
        <a href="admin_schedule.php">Schedule</a>
        <a href="admin_client.php">Client</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="main">
        <div class="container">
            <h3>Add Tipe Tiket</h3>
            <form action="admin_add_type.php" method="post">
            <table>
                    <tr>
                        <td><input type="text" placeholder="Kelas" name="kelas" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="Harga" name="harga" required oninput="this.value = this.value.replace(/[^0-9]/g, '');"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Tambahkan" name="submit"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    
</body>
</html>

<?php
    require_once "connection.php";
    if(isset($_POST['submit'])){
        $kelas = $_POST['kelas'];
        $harga = $_POST['harga'];
        mysqli_query($conn,"INSERT INTO type_ticket (class,price) VALUES('$kelas','$harga')");
        header("Location:admin_schedule.php");
    }
?>