<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Online</title>
</head>
<body>
    <form action="add.php" method="post">
        <table>
            <tr>
                <td><input type="text" placeholder="City" name="city" id="city"> </td>
            </tr>
            <tr>
                <td><input type="time" name="jam_keberangkatan" id="jam_keberangkatan"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit"></td>
            </tr>
            
        </table>
    </form>
</body>
</html>
<?php
    require_once "connection.php";
    if(isset($_POST['submit'])){
        $city = $_POST['city'];
        $time = $_POST['jam_keberangkatan'];
        mysqli_query($conn,"INSERT INTO jadwal (city,jam_keberangkatan) VALUES('$city','$time')");
        header('Location:admin/schedule.php');
    }
?>