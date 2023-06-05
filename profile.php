<?php
session_start();
include("baglanti.php");

// Mesajı gönderen kullanıcının adını ve mesaj içeriğini al
if (isset($_POST["gonder"])) {
    $gonderen = $_SESSION["user_name"]; // Kullanıcı adını session'dan al

    $mesaj = $_POST["mesaj"];

    // Güvenlik önlemleri
    $mesaj = mysqli_real_escape_string($baglanti, $mesaj);

    // Mesajı admin kişisine kaydet
    $ekle = "INSERT INTO mesajlar (user_name, mesaj) VALUES ('$gonderen', '$mesaj')";
    $eklestart = mysqli_query($baglanti, $ekle);

    if ($eklestart) {
        echo '<div class="alert alert-success" role="alert">
            Mesajınız gönderildi!
        </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
            Mesaj gönderilirken bir hata oluştu.
        </div>';
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
    <title>Mesaj Gönder</title>
</head>
<body>
<h1>Mesaj Gönder</h1>
<div class="container">
    <div class="card">
        <form action="" method="post">
            <label for="gonderen">Gönderen:</label>
            <input type="text" id="gonderen" name="gonderen" placeholder="Adınızı girin" value="<?php echo $_SESSION['user_name']; ?>" readonly>

            <label for="mesaj">Mesaj:</label>
            <textarea id="mesaj" name="mesaj" placeholder="Mesajınızı girin"></textarea>

            <input type="submit" name="gonder" value="Gönder">
        </form>
    </div>
</div>
</body>
</html>