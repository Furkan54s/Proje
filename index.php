<?php
include("baglanti.php");

if (isset($_POST["Kaydet"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Şifreyi hashle
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Kullanıcı adı veya e-posta adresi çakışmasını kontrol et
    $kontrol = "SELECT * FROM users WHERE user_name='$name' OR email='$email'";
    $calistir = mysqli_query($baglanti, $kontrol);

    if ($calistir && mysqli_num_rows($calistir) > 0) {
        echo '<div class="alert alert-danger" role="alert">
            Kullanıcı adı veya e-posta zaten kullanılıyor!
        </div>';
    } else {
        $ekle = "INSERT INTO users (user_name, email, parola) VALUES ('$name', '$email', '$hashedPassword')";
        $eklestart = mysqli_query($baglanti, $ekle);

        if ($eklestart) {
            echo '<div class="alert alert-success" role="alert">
                Kayıt Başarılı
                
            </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                Kayıt Başarısız!
               
            </div>';
        }
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
    <title>Kayıt ol</title>
</head>
<body>
<h1>Kayıt ol</h1>
<div class="container">
    <div class="card">
        <form action="index.php" method="post">
            <label for="name">Ad:</label>
            <input type="text" id="name" name="name" placeholder="Adınızı girin">

            <label for="email">E-posta:</label>
            <input type="text" id="email" name="email" placeholder="E-posta adresinizi girin">

            <label for="password">Şifre:</label>
            <input type="password" id="password" name="password" placeholder="Şifrenizi girin">

            <input type="submit" name="Kaydet" value="Kaydet">
        </form>
        <form action="login.php" method="post">
            <input type="submit" name="login" value="Giriş Yap">
        </form>
    </div>
</div>
</body>
</html>