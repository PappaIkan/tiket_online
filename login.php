<?php
require_once 'connection.php';
session_start();

// Autentikasi login
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Gunakan prepared statement untuk menghindari SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND password=?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $_SESSION['login'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $email;
        $_SESSION['role'] = $row['role'];

        // Arahkan berdasarkan role
        if ($row['role'] == 'admin') {
            header("Location: admin.php");
        } elseif ($row['role'] == 'user') {
            header("Location: index.php");
        }
        exit;
    } else {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halaman Login</title>
    <style>
        .inner {
            margin: 100px auto;
            padding: 50px;
            width: 300px;
            border: 1px solid #333;
        }
    </style>
</head>
<body>
    <div class="inner">
        <h1>Halaman Login</h1>
        <?php if (isset($error)): ?>
            <p style="color: red; font-style: italic;">Email atau password salah</p>
        <?php endif; ?>
        <form action="" method="post">
            <table border=0 cellpadding=5>
                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input type="text" name="email" id="email"></td>
                </tr>
                <tr>
                    <td><label for="password">Password</label></td>
                    <td><input type="password" name="password" id="password"></td>
                </tr>
                <tr>
                    <td><button type="submit" name="login">Login</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
