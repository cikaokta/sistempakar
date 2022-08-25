<?php
//include'functions.php';
$terjawab = get_terjawab();
$relasi = get_relasi($terjawab);
$kode_gejala = get_next_gejala($relasi);

$success = @$_GET['success'];
$row = $db->get_row("SELECT * FROM tb_gejala WHERE kode_gejala='$kode_gejala'");

$count = $db->get_var("SELECT COUNT(*) FROM tb_konsultasi");
    
if(!$row){
    $success = true;        
}        
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Sistem Pakar Diagnosis Stroberi</title>
    <link href="assets/css/yeti-bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/general.css" rel="stylesheet"/>
    <link href="assets/css/select2.min.css" rel="stylesheet"/>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>    
    <script src="assets/js/select2.min.js"></script>   
    <style type="text/css">
    .hi{
background-image: linear-gradient(rgba(0, 0, 0, 0),rgba(0, 0, 0, 0)), url('back.jpg');
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    background-attachment: fixed;
  }
.dark{
  background-color: #fff;
  color: #000;
}
.page-header{
    color: #000;
}
.latar{
        background-color: #636e72;
    }
    .tambah{
        background-color:   #353b48;
    }
    .tambah:hover{
        background-color:   #718093;
        color: #fff;
    }
     .edit{
        background-color: #2f3640;
    }
    .edit:hover{
        background-color:   #718093;
        color: #fff;
    }
    </style>      
  </head>
  <body class="dark hi" >
<div class="page-header">
    <h1 align="center"><b>Simulasi Konsultasi</b></h1>
</div>
<?php if($success) :?>
    <div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><b>Riwayat Pertanyaan</b></h3>
    </div>
    <div class="list-group">
        <?php 
        $rows = $db->get_results("SELECT * FROM tb_konsultasi k INNER JOIN tb_gejala g ON g.kode_gejala=k.kode_gejala");
        foreach($rows as $row):?>
        <div class="list-group-item"><?=$row->ID?>. Apakah <?=strtolower($row->nama_gejala)?>? <strong><?=$row->jawaban?></strong></div>
        <?php endforeach?>
    </div>    
</div>
<?php include'konsu_has.php';
else:?>
<div class="panel panel-default">
    <div class="panel-body" style="background-color: #FFFFFF; color: #000;">
        <h3 align="center"><b>Apakah <?=strtolower($row->nama_gejala)?>?</b></h3>
        <div align="center">
            <?php if($row->gambar == null){?>
                <h3 align="center">Tidak Ada Gambar</h3>
            <?php }else{?>
        <img src="gambar/<?php echo $row->gambar?>" width="300px" height="300px">
        <?php }?>
        </div>
        <form action="aksi.php?m=konsu" method="post">
            <input type="hidden" name="kode_gejala" value="<?=$row->kode_gejala?>" />
            <p>&nbsp;</p>
            <p align="center">
                <button name="yes" class="btn tambah" value="1"><span class="glyphicon glyphicon-ok-sign"></span> Ya</button>
                <button name="no" class="btn tambah" value="1"><span class="glyphicon glyphicon-remove-sign"></span> Tidak</button> 
                
                <?php if($count):?>           
                <a class="btn edit" href="aksi.php?m=konsu&act=new"><span class="glyphicon glyphicon-ban-circle"></span> Batal</a>
                <?php endif?>
            </p>
        </form>
    </div>
</div>
<?php endif?>

</body></html>