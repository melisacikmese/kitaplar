<?php
/* Bağlantı bilgileri */
require_once("baglanti.php");

/* ID kontrolü */
if (!isset($_GET["kitapID"])) {
    die("Silinecek kayıt bulunamadı.");
}

/* Güvenli ID alma */
$kitapID = mysqli_real_escape_string($baglanti, $_GET["kitapID"]);

/* Silme sorgusu */
$sorgu = "DELETE FROM kitaplar WHERE kitapID = '$kitapID'";

if (mysqli_query($baglanti, $sorgu)) {
    mysqli_close($baglanti);

    if (!headers_sent()) {
        header("Location: index.php");
        exit;
    }
} else {
    echo "Silme sırasında hata oluştu: " . mysqli_error($baglanti);
}
?>
