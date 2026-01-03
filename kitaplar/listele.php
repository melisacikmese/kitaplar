<button onclick="history.back()">⬅ Geri</button>
<?php
require_once("baglanti.php");

/* Veritabanı sorgulama */
$sorgu = mysqli_query($baglanti, "SELECT * FROM kitaplar");
$toplam = mysqli_num_rows($sorgu);

echo "<h2>Toplam Kitap Sayısı: ".$toplam."</h2>";

while ($satir = mysqli_fetch_assoc($sorgu)) {
    echo "<p>";
    echo "<b>Kitap ID:</b> ".$satir["kitapID"]."<br>";
    echo "<b>Kitap Kayıt Tarihi:</b> ".$satir["kitapZD"]."<br>";
    echo "<b>Kitap Adı:</b> ".$satir['kitapAdi']."<br>";
    echo "<b>Kitap URL:</b> 
          <a target='_blank' href='".$satir["kitapURL"]."'>
          ".$satir["kitapURL"]."</a><br>";
    echo "<b>Kitap Yayın Yılı:</b> ".$satir["kitapyayinyili"]."<br>";

    /* 🔗 Silme linki */
    echo "<a href='sil.php?kitapID=".$satir["kitapID"]."'
          onclick=\"return confirm('Bu kitabı silmek istediğinize emin misiniz?');\">
          🗑 Sil</a>";

    echo "</p>";
    echo "<hr>";
}
?>

