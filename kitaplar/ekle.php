<button onclick="history.back()">⬅ Geri</button>
<?php
require_once("baglanti.php");

/* Form gönderildiyse */
if (isset($_POST["kaydet"])) {

    $kitapAdi = $_POST["kitapAdi"];
    $kitapURL = $_POST["kitapURL"];
    $kitapYil = $_POST["kitapyayinyili"];

    $sorgu = mysqli_query($baglanti, "
        INSERT INTO kitaplar (kitapAdi, kitapURL, kitapyayinyili)
        VALUES ('$kitapAdi', '$kitapURL', '$kitapYil')
    ");

    if ($sorgu) {
        echo "<p style='color:green'>Eser başarıyla eklendi.</p>";
    } else {
        echo "<p style='color:red'>Hata oluştu: ".mysqli_error($baglanti)."</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Eser Ekle</title>
</head>
<body>

<h2>Yeni Eser Ekle</h2>

<form method="post">
    <label>Eser Adı:</label><br>
    <input type="text" name="kitapAdi" required><br><br>

    <label>Eser URL:</label><br>
    <input type="url" name="kitapURL" required><br><br>

    <label>Yayın Yılı:</label><br>
    <input type="number" name="kitapyayinyili" required><br><br>

    <button type="submit" name="kaydet">Kaydet</button>
</form>

<br>
<a href="listele.php">← Listeye Dön</a>

</body>
</html>
