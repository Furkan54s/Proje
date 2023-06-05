<?php
include("baglanti.php");

if (isset($_POST["giris"])) {
    $name = $_POST["name"];
    $password = $_POST["password"];

    // Güvenlik önlemleri
    $name = mysqli_real_escape_string($baglanti, $name);

    // Kullanıcı adı ve parolayı kontrol et
    $secim = "SELECT * FROM users WHERE user_name='$name'";
    $calistir = mysqli_query($baglanti, $secim);

    if ($calistir) {
        if (mysqli_num_rows($calistir) > 0) {
            $ilgilikayit = mysqli_fetch_assoc($calistir);
            $hashlisifre = $ilgilikayit["parola"];
            $passwordMatch = password_verify($password, $hashlisifre);

            $calistir = mysqli_query($baglanti, $secim);
            if (!$calistir) {
                echo 'Sorgu hatası: ' . mysqli_error($baglanti);
            }

            if (password_verify($password, $hashlisifre)) {
                session_start();
                $_SESSION["user_name"] = $ilgilikayit["user_name"];
                header("Location: profile.php");
                exit;
            } else {
                echo '<div class="alert alert-danger" role="alert">Parola Yanlıs</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Kullanıcı Adı Yanlış</div>';
        }
    } else {
        echo 'Sorgu hatası: ' . mysqli_error($baglanti);
    }

    mysqli_close($baglanti);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stilim.css">
    <title>Giriş</title>
</head>
<body>
<h1>Giriş Yap</h1>
<div class="container">
    <div class="card">
        <form action="login.php" method="post">
            <label for="name">Ad:</label>
            <input type="text" id="name" name="name" placeholder="Adınızı girin">
            <label for="password">Şifre:</label>
            <input type="password" id="password" name="password" placeholder="Şifrenizi girin">

            <input type="submit" name="giris" value="Giriş Yap">
        </form>
        <form action="index.php" method="post">
            <input type="submit" name="kayit" value="Kayıt Ol" onclick="window.location.href='index.php'">
        </form>
        <form action="adminlogin.php" method="post">
            <input type="submit" name="admin_giris" value="Admin Girişi" onclick="window.location.href='adminlogin.php'">
        </form>
    </div>
</div>
</body>
</html>