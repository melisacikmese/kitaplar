<?php
    /* Veritabanı bağlantı bilgileri */
    $sunucu = "localhost";
    $kullanici = "bby361";
    $sifre = "Hacettepe2025";
    $veritabani = "bby361_melisacikmese";
    $port = 3306;

    /* Veritabanına bağlantı */
    $baglanti = mysqli_connect($sunucu, $kullanici, $sifre, $veritabani, 3306)
    or die("Veritabanına bağlantı gerçekleştirilemedi..!");

    /* Türkçe karakterler için düzenleme */
    mysqli_set_charset($baglanti,"utf8");
?>