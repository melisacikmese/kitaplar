<?php
require_once("baglanti.php");
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>VTYS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 40px;
        }
        .menu a, button {
            display: inline-block;
            margin: 8px;
            padding: 12px 22px;
            background-color: #d094e0ff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }
        .menu a:hover, button:hover {
            opacity: 0.9;
        }
        .kutu {
            width: 70%;
            margin: 30px auto;
            text-align: left;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 6px;
        }
        .btn {
            display: inline-block;
            padding: 15px 30px;
            background-color: #2c7be5;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 18px;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #1a5dc9;
        }
    </style>
</head>

<body>

<h1>VTYS</h1>

<!-- 📌 MENÜ -->
<div class="menu">
    <a href="listele.php">📄 Kitapları Listele</a>
    <a href="ekle.php">➕ Kitap Ekle</a>
    <a href="guncelle.php" class="btn">✏️ Kitap Güncelle</a>
</div>

<!-- 🔍 KİTAP ARAMA -->
<div class="kutu">
    <h2>🔍 Kitap Ara</h2>

    <form method="get" action="index.php">
        <input type="text" name="q" placeholder="Kitap adı giriniz" required>
        <button type="submit">Ara</button>
    </form>

<?php
if (isset($_GET["q"])) {
    $q = mysqli_real_escape_string($baglanti, $_GET["q"]);
    $sorgu = mysqli_query(
        $baglanti,
        "SELECT * FROM kitaplar WHERE kitapAdi LIKE '%$q%'"
    );

    echo "<h3>Arama Sonuçları</h3>";

    if (mysqli_num_rows($sorgu) == 0) {
        echo "<p>Kayıt bulunamadı.</p>";
    }

    while ($satir = mysqli_fetch_assoc($sorgu)) {
        echo "<p>";
        echo "<b>".$satir["kitapAdi"]."</b> (".$satir["kitapyayinyili"].")<br>";
        echo "<a target='_blank' href='".$satir["kitapURL"]."'>".$satir["kitapURL"]."</a><br>";
        echo "<a href='guncelle.php?kitapID=".$satir["kitapID"]."'>✏️ Güncelle</a>";
        echo "</p><hr>";
    }
}
?>
</div>

</body>
</html>
