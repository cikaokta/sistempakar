<?php
require_once'functions.php';
 
if ($mod=='login'){
    $user = esc_field($_POST['user']);
    $pass = esc_field($_POST['pass']);
    
    $row = $db->get_row("SELECT * FROM tb_admin WHERE user='$user' AND pass='$pass'");
    if($row){
        $_SESSION['login'] = $row->user;
        redirect_js("index.php");
    } else{
        print_msg("Salah kombinasi username dan password.");
    }          
}else if ($mod=='password'){
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $pass3 = $_POST['pass3'];
    
    $row = $db->get_row("SELECT * FROM tb_admin WHERE user='$_SESSION[login]' AND pass='$pass1'");        
    
    if($pass1=='' || $pass2=='' || $pass3=='')
        print_msg('Field bertanda * harus diisi.');
    elseif(!$row)
        print_msg('Password lama salah.');
    elseif( $pass2 != $pass3 )
        print_msg('Password baru dan konfirmasi password baru tidak sama.');
    else{        
        $db->query("UPDATE tb_admin SET pass='$pass2' WHERE user='$_SESSION[login]'");                    
        print_msg('Password berhasil diubah.', 'success');
    }
} elseif($act=='logout'){
    unset($_SESSION['login']);
    header("location:index.php?m=login");
}

/** DIAGNOSA */
elseif($mod=='diagnosa_tambah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $penyebab = $_POST['penyebab'];
    $solusi = $_POST['solusi'];
    $gambar = $_POST['gambar'];

    if($kode=='' || $nama=='')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    elseif($db->get_row("SELECT * FROM tb_diagnosa WHERE kode_diagnosa='$kode'"))
        print_msg("Kode sudah ada!");
    else{
        $db->query("INSERT INTO tb_diagnosa (kode_diagnosa, nama_diagnosa, penyebab, solusi, gambar) VALUES ('$kode', '$nama', '$penyebab' , '$solusi', '$gambar')");                       
        redirect_js("index.php?m=diagnosa");
    }
} else if($mod=='diagnosa_ubah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $penyebab = $_POST['penyebab'];
    $solusi = $_POST['solusi'];
    $gambar = $_POST['gambar'];
    if($kode=='' || $nama=='')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    else{
        $db->query("UPDATE tb_diagnosa SET nama_diagnosa='$nama', penyebab='$penyebab' , solusi='$solusi', gambar='$gambar' WHERE kode_diagnosa='$_GET[ID]'");
        redirect_js("index.php?m=diagnosa");
    }
} else if ($act=='diagnosa_hapus'){
    $db->query("DELETE FROM tb_diagnosa WHERE kode_diagnosa='$_GET[ID]'");
    $db->query("DELETE FROM tb_relasi WHERE kode_diagnosa='$_GET[ID]'");
    header("location:index.php?m=diagnosa");
} 

/** GEJALA */    
elseif($mod=='gejala_tambah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $keterangan = $_POST['keterangan'];
    
    $gambar = basename($_FILES['image']['name']);
    $namaSementara = $_FILES['image']['tmp_name'];

    if($kode=='' || $nama=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif($db->get_row("SELECT * FROM tb_gejala WHERE kode_gejala='$kode'"))
        print_msg("Kode sudah ada!");
    else{
        $dirUpload = "gambar/";
        $terupload = move_uploaded_file($namaSementara, $dirUpload.$gambar);

        if ($terupload) {
$db->query("INSERT INTO tb_gejala (kode_gejala, nama_gejala, keterangan, gambar) VALUES ('$kode', '$nama', '$keterangan', '$gambar')");                   
        redirect_js("index.php?m=gejala");
  
        }else{
             print_msg("Upload Gagal!");
            
        }
        //  $db->query("INSERT INTO tb_gejala (kode_gejala, nama_gejala, keterangan, gambar) VALUES ('$kode', '$nama', '$keterangan', '$gambar')");                   
        // redirect_js("index.php?m=gejala");
       
    }                    
} else if($mod=='gejala_ubah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $keterangan = $_POST['keterangan'];
    
    if($kode=='' || $nama=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    else{
        $db->query("UPDATE tb_gejala SET nama_gejala='$nama', keterangan='$keterangan' WHERE kode_gejala='$_GET[ID]'");
        redirect_js("index.php?m=gejala");
    }    
} else if ($act=='gejala_hapus'){
    $db->query("DELETE FROM tb_gejala WHERE kode_gejala='$_GET[ID]'");
    $db->query("DELETE FROM tb_relasi WHERE kode_gejala='$_GET[ID]'");
    header("location:index.php?m=gejala");
} 
    
/** RELASI TAMBAH */ 
else if ($mod=='relasi_tambah'){
    $kode_diagnosa = $_POST['kode_diagnosa'];
    $kode_gejala = $_POST['kode_gejala'];
    $mb = $_POST['mb'];
    $md = $_POST['md'];
    
    $kombinasi_ada = $db->get_row("SELECT * FROM tb_relasi WHERE kode_diagnosa='$kode_diagnosa' AND kode_gejala='$kode_gejala'");
    
    if($kode_diagnosa=='' || $kode_gejala=='' || $mb=='' || $md=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif($kombinasi_ada)
        print_msg("Kombinasi diagnosa dan gejala sudah ada!");
    else{
        $db->query("INSERT INTO tb_relasi (kode_diagnosa, kode_gejala, mb, md) VALUES ('$kode_diagnosa', '$kode_gejala', '$mb', '$md')");
        redirect_js("index.php?m=relasi");
    }   
}else if ($mod=='relasi_ubah'){
    $kode_diagnosa = $_POST['kode_diagnosa'];
    $kode_gejala = $_POST['kode_gejala'];
    $mb = $_POST['mb'];
    $md = $_POST['md'];
    
    $kombinasi_ada = $db->get_row("SELECT * FROM tb_relasi WHERE kode_diagnosa='$kode_diagnosa' AND kode_gejala='$kode_gejala' AND ID<>'$_GET[ID]'");
    
    if($kode_diagnosa=='' || $kode_gejala=='' || $mb=='' || $md=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif($kombinasi_ada)
        print_msg("Kombinasi diagnosa dan gejala sudah ada!");
    else{
        $db->query("UPDATE tb_relasi SET kode_diagnosa='$kode_diagnosa', kode_gejala='$kode_gejala', mb='$mb', md='$md' WHERE ID='$_GET[ID]'");
        redirect_js("index.php?m=relasi");
    }  
    header("location:index.php?m=relasi");
} else if ($act=='relasi_hapus'){
    $db->query("DELETE FROM tb_relasi WHERE ID='$_GET[ID]'");
    header("location:index.php?m=relasi");
} else if ($act=='laporan_hapus'){
    $db->query("DELETE FROM tb_hasil WHERE ID='$_GET[ID]'");
    header("location:index.php?m=laporan");
} else if ($mod=='konsultasi') {
    if($_POST['yes'])
        $db->query("INSERT INTO tb_konsultasi (kode_gejala, jawaban) VALUES ('$_POST[kode_gejala]', 'Ya')");
    elseif($_POST['no'])
        $db->query("INSERT INTO tb_konsultasi (kode_gejala, jawaban) VALUES ('$_POST[kode_gejala]', 'Tidak')");
    elseif($act=='new')
        $db->query("TRUNCATE TABLE tb_konsultasi");
        
    header("location:index.php?m=konsultasi");
} else if ($mod=='konsu') {
    if($_POST['yes'])
        $db->query("INSERT INTO tb_konsultasi (kode_gejala, jawaban) VALUES ('$_POST[kode_gejala]', 'Ya')");
    elseif($_POST['no'])
        $db->query("INSERT INTO tb_konsultasi (kode_gejala, jawaban) VALUES ('$_POST[kode_gejala]', 'Tidak')");
    elseif($act=='new')
        $db->query("TRUNCATE TABLE tb_konsultasi");
        
    header("location:index.php?m=konsu");
}