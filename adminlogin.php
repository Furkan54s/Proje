

    <!doctype html>
    <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stilim.css">
    <title>Admin Girişi</title>
</head>
<body>
<h1>Admin Girişi</h1>
<div class="container">
    <div class="card">
        <form action="" method="post">
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" id="username" name="username" placeholder="Kullanıcı adınızı girin">

            <label for="password">Şifre:</label>
            <input type="password" id="password" name="password" placeholder="Şifrenizi girin">

            <input type="submit" name="submit" value="Giriş">
        </form>
        <?php if(isset($hata)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $hata; ?>
            </div>
        <?php } ?>
    </div>
</div>
</body>
    </html>
    <?php

    session_start();
    include("baglanti.php");


    if ($_POST["username"] == "admin" && $_POST["password"] == "0000") {
        // Kullanıcı adı ve şifre doğruysa oturum başlatılıyor
        $_SESSION["admin_username"] = $_POST["username"];
        header("Location: admin.php");
        exit;
    } else {

        $hata = "Kullanıcı adı veya şifre hatalı.";
    }
?>
