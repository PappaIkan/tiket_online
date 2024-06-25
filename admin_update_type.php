<?php
session_start();

// Periksa apakah pengguna sudah login dan apakah role adalah admin
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php"); // Arahkan ke halaman login jika belum login atau bukan admin
    exit;
}
    require_once "connection.php";
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $kelas = $_POST['kelas'];
        $harga = $_POST['harga'];
        mysqli_query($conn,"UPDATE type_ticket SET class = '$kelas',price = '$harga' WHERE id = '$id'");
        header("Location:admin_schedule.php");


    }?>
    <?php
    $id = $_GET['id'];
    if (!isset($_GET['id'])) {
        header("Location: admin_schedule.php");
        exit;
    }
    $query = mysqli_query($conn,"SELECT * FROM type_ticket WHERE id = $id ");
    while($row = mysqli_fetch_array($query)){?>
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
        <div class="sidenav">
            <div class="title">Welcome Admin</div>
            <a href="admin.php">Dashboard</a>
            <a href="admin_schedule.php">Schedule</a>
            <a href="admin_client.php">Client</a>
            <a href="logout.php">Logout</a>
        </div>
        <div class="main">
            <div class="container">
                <h3>Edit Tipe Tiket</h3>
                <form action="admin_update_type.php" method="post">
                <table>
                    <tr>
                        <td><input type="text" placeholder="ID" name="id" value="<?= $row['id'];?>" readonly></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="Kelas" name="kelas" value="<?= $row['class'];?>" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="Harga" name="harga" value="<?= number_format($row['price']);?>" required oninput="this.value = this.value.replace(/[^0-9]/g, '');"></td>
                    </tr>
                    <tr>
                        <td><input type="submit"  name="submit" value="Tambahkan"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <?php   
    }  
    ?>