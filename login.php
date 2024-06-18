<?php
require_once 'connection.php';
session_start();

// cek cookie
if (isset($_COOKIE['username']) && isset($_COOKIE['pass'])) {
    $username = $_COOKIE['username'];
    $pass = $_COOKIE['pass'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$username' AND password='$pass'");
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    }
}

// cek session
if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

// autentikasi login
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$username' AND password='$password'");

    // cek username dan password
    if (mysqli_num_rows($result) === 1) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;

        // cek remember me
        if (isset($_POST['remember'])) {
            // buat cookie
            setcookie('username', $username, time() + 86400); // 1 hari
            setcookie('pass', $password, time() + 86400); // 1 hari
        }
        header("Location: index.php");
        exit;
    }
    $error = true;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Halaman Login</title>
    <style type="text/css">
        .inner {
            margin: 200px auto;
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
            <p style="color: red; font-style: italic;">username / password salah</p>
        <?php endif; ?>
        <form action="" method="post">
            <table border=0 cellpadding=5>
                <tr>
                    <td><label for="username">Email </label></td>
                    <td><input type="text" name="username" id="username"></td>
                </tr>
                <tr>
                    <td><label for="password">Password </label></td>
                    <td><input type="password" name="password" id="password"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="checkbox" name="remember" id="remember">
                        <label for="remember">Remember me</label>
                    </td>
                </tr>
                <tr>
                    <td><button type="submit" name="login">Login</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>
