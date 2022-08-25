<?php 
 require_once 'functions.php';
    
    $nama =$_POST['nama'];
    $email =$_POST['email'];
    $jk=$_POST['jk'];
    $alamat =$_POST['alamat'];
    $tgl =$_POST['tgl'];
    
    
    
    $db->query("INSERT INTO tb_hasil(nama, email,jk,alamat,tgl) VALUES('$nama','$email','$jk','$alamat','$tgl')");
	
	echo "<meta http-equiv='refresh' content='0; url=aksi.php?m=konsultasi&act=new'>";
?>

