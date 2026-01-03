<?php
require_once("baglanti.php");

/* Güncelleme yapıldıysa */
if (isset($_POST["guncelle"])) {

    $kitapID = mysqli_real_escape_string($baglanti, $_POST["kitapID"]);
    $kitapAdi = mysqli_real_escape_string($baglanti, $_POST["kitapAdi"]);
    $kitapURL = mysqli_real_escape_string($baglanti, $_POST["kitapURL"]);
    $kitapYil = mysqli_real_escape_string($baglanti, $_POST["kitapyayinyili"]);

    $sorgu = "
        UPDATE kitaplar SET
            kitapAdi = '$kitapAdi',
            kitapURL = '$kitapURL',
            kitapyayinyili = '$kitapYil'
        WHERE kitapID = '$kitapID'
    ";

    if (mysqli_query($baglanti, $sorgu)) {
        echo "<p style='color:green'>Güncelleme başarılı.</p>";
    } else {
        echo "Hata: " . mysqli_error($baglanti);
    }
}

/* Kitap seçildiyse bilgileri getir */
$seciliKitap = null;
if (isset($_GET["kitapID"])) {
    $id = mysqli_real_escape_string($baglanti, $_GET["kitapID"]);
    $sonuc = mysqli_query($baglanti, "SELECT * FROM kitaplar WHERE kitapID='$id'");
    $seciliKitap = mysqli_fetch_assoc($sonuc);
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kitap Güncelle</title>
</head>
<body>

<h2>✏️ Kitap Güncelle</h2>

<!-- 📌 Kitap Seç -->
<form method="get" action="guncelle.php">
    <label>Güncellenecek Kitap:</label><br>
    <select name="kitapID" required>
        <option value="">-- Kitap Seçiniz --</option>
        <?php
        $kitaplar = mysqli_query($baglanti, "SELECT kitapID, kitapAdi FROM kitaplar");
        while ($k = mysqli_fetch_assoc($kitaplar)) {
            $secili = ($seciliKitap && $k["kitapID"] == $seciliKitap["kitapID"]) ? "selected" : "";
            echo "<option value='".$k["kitapID"]."' $secili>".$k["kitapAdi"]."</option>";
        }
        ?>
    </select>
    <button type="submit">Seç</button>
</form>

<hr>

<?php if ($seciliKitap) { ?>
<!-- ✏️ Güncelleme Formu -->
<form method="post">
    <input type="hidden" name="kitapID" value="<?= $seciliKitap['kitapID'] ?>">

    <label>Kitap Adı:</label><br>
    <input type="text" name="kitapAdi"
           value="<?= $seciliKitap['kitapAdi'] ?>" required><br><br>

    <label>Kitap URL:</label><br>
    <input type="url" name="kitapURL"
           value="<?= $seciliKitap['kitapURL'] ?>" required><br><br>

    <label>Yayın Yılı:</label><br>
    <input type="number" name="kitapyayinyili"
           value="<?= $seciliKitap['kitapyayinyili'] ?>" required><br><br>

    <button type="submit" name="guncelle">Güncelle</button>
</form>
<?php } ?>

<hr>
<a href="index.php">⬅ Ana Sayfaya Dön</a>

</body>
</html>
