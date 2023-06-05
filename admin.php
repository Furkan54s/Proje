<?php
session_start();
include("baglanti.php");

// Yönetici girişi kontrolü yapılıyor
if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit;
}

// Mesajları veritabanından al
$mesajlarSorgusu = "SELECT * FROM mesajlar";
$mesajlarSonucu = mysqli_query($baglanti, $mesajlarSorgusu);

?>

    <!doctype html>
    <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Admin Paneli</title>
</head>
<body>
<h1>Admin Paneli - Mesajlar</h1>
<div class="container">
    <div class="card">
        <table>
            <tr>
                <th>Gönderen</th>
                <th>Mesaj</th>
            </tr>
            <?php
            // Mesajları döngüyle listele
            while ($row = mysqli_fetch_assoc($mesajlarSonucu)) {
                $gonderen = $row['user_name'];
                $mesaj = $row['mesaj'];
                ?>
                <tr>
                    <td><?php echo $gonderen; ?></td>
                    <td><?php echo $mesaj; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
</body>
    </html><?php
