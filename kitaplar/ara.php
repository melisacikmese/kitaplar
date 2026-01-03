<?php
/* Bağlantı bilgileri */
require_once("baglanti.php");
?>

<form method="get" action="ara.php">
    <input type="text" name="q" placeholder="Kitap adı ara">
    <input type="submit" value="Ara">
</form>

<?php
/* Arama yapıldıysa */
if (isset($_GET["q"])) {

    $q = mysqli_real_escape_string($baglanti, $_GET["q"]);

    /* Veritabanı sorgulama */
    $sorgu = mysqli_query(
        $baglanti,
        "SELECT * FROM kitaplar WHERE kitapAdi LIKE '%$q%'"
    );

    $toplam = mysqli_num_rows($sorgu);
    echo "<h2>Bulunan Kitap Sayısı: ".$toplam."</h2>";

    while ($satir = mysqli_fetch_assoc($sorgu)) {
        echo "<p>";
        echo "<b>Kitap ID:</b> ".$satir["kitapID"]."<br>";
        echo "<b>Kitap Kayıt Tarihi:</b> ".$satir["kitapZD"]."<br>";
        echo "<b>Kitap Adı:</b> ".$satir["kitapAdi"]."<br>";
        echo "<b>Kitap URL:</b> 
              <a target='_blank' href='".$satir["kitapURL"]."'>
              ".$satir["kitapURL"]."</a><br>";
        echo "<b>Kitap Yayın Yılı:</b> ".$satir["kitapyayinyili"]."<br>";
        echo "<hr>";
    }
}
?>
