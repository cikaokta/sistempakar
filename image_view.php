<?php
include ('koneksi.php');
if(isset($_GET[ID]))
{
    $query = mysql_quert($koneksi, "SELECT * FROM tb_diagnosa WHERE kode_diagnosa='". $_GET[ID]."'");
    $row = mysql_fetch_array($query);
    header("Content-type: ". $row["tipe_gambar"]);
    echo $row["gambar"];
}
else{
    header('location:hasil.php');
}