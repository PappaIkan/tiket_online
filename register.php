<?php
require_once 'connection.php';
session_start();

// Proses registrasi
if (isset($_POST["register"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = 'user';  // Menetapkan role sebagai 'user' secara default

    // Gunakan prepared statement untuk menghindari SQL injection
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $role); // Mengikat parameter name, email, password, dan role
    if ($stmt->execute()) {
        $_SESSION['login'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $name;
        $_SESSION['id'] = $stmt->insert_id;
        $_SESSION['role'] = $role;

        header("Location: index.php");
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
    <title>Halaman Register</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .inner {
            margin: 100px auto;
            padding: 50px;
            width: 300px;
            border: 1px solid #333;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
        }

        table td {
            padding: 10px 0;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        .error {
            color: red;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="inner">
        <h1>Halaman Register</h1>
        <?php if (isset($error)): ?>
            <p class="error">Terjadi kesalahan saat registrasi</p>
        <?php endif; ?>
        <form action="" method="post">
            <table border=0 cellpadding=5>
                <tr>
                    <td><label for="name">Nama</label></td>
                    <td><input type="text" name="name" id="name" required></td>
                </tr>
                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input type="email" name="email" id="email" required></td>
                </tr>
                <tr>
                    <td><label for="password">Password</label></td>
                    <td><input type="password" name="password" id="password" required></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="register" value="Register"></td>
                </tr>
            </table>
            <div style="text-align:center;"><a href="login.php">jika anda sudah memiliki akun ? <a href="login.php" style="color:blue">daftar</a></a></div>
        </form>
    </div>
</body>
</html>
