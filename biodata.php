<?php 
function TanggalIndonesia($date) {
    $date = date('Y-m-d',strtotime($date));
    if($date == '0000-00-00')
        return 'Tanggal Kosong';
 
    $tgl = substr($date, 8, 2);
    $bln = substr($date, 5, 2);
    $thn = substr($date, 0, 4);
 
    switch ($bln) {
        case 1 : {
                $bln = 'Januari';
            }break;
        case 2 : {
                $bln = 'Februari';
            }break;
        case 3 : {
                $bln = 'Maret';
            }break;
        case 4 : {
                $bln = 'April';
            }break;
        case 5 : {
                $bln = 'Mei';
            }break;
        case 6 : {
                $bln = "Juni";
            }break;
        case 7 : {
                $bln = 'Juli';
            }break;
        case 8 : {
                $bln = 'Agustus';
            }break;
        case 9 : {
                $bln = 'September';
            }break;
        case 10 : {
                $bln = 'Oktober';
            }break;
        case 11 : {
                $bln = 'November';
            }break;
        case 12 : {
                $bln = 'Desember';
            }break;
        default: {
                $bln = 'UnKnown';
            }break;
    }
 
 
    $tanggalIndonesia = "".$tgl . " " . $bln . " " . $thn;
    return $tanggalIndonesia;
}
 ?>
<body class="dark hi" >
<div class="page-header">
    <h1 style="color: #fff;">Isi Data Konsultasi</h1>
</div>
<form action="?m=daftar" method="post">
  <div class="form-group" style="width: 400px">
                <p style="color: #fff;" align="left"><b>Nama</b> <span class="text-danger">*</span></p>
                <p><input class="form-control" style="width: 400px" type="text" placeholder="Masukkan Nama. . ." name="nama" value="<?=@$_GET['q']?>" /></p>
  </div>
  <div class="form-group" style="width: 400px">
                <p style="color: #fff;" align="left"><b>Email</b> <span class="text-danger">*</span></p>
                <input style="color: #000;" class="form-control" type="text" name="email" required placeholder="Masukkan Email" />
  </div>

    <div class="form-group" style="width: 400px">
                <p style="color: #fff;" align="left"><b>Jenis Kelamin</b> <span class="text-danger">*</span></p>
               <p align="left"> <input type="radio" name="jk" value="Laki - Laki"><b> Laki - Laki   </b><input type="radio" name="jk" value="Perempuan"><b> Perempuan</b></p>
  </div>

    <div class="form-group" style="width: 400px">
                <p style="color: #fff;" align="left"><b>Alamat</b> <span class="text-danger">*</span></p>
                <input style="color: #000;" class="form-control" type="text" name="alamat" required placeholder="Masukkan Alamat" />
  </div>

  <div class="form-group" style="width: 400px">
                <p style="color: #fff;" align="left"><b>Tanggal Konsultasi</b> <span class="text-danger">*</span></p>
                <input type="text" class="form-control" readonly name="tgl" value="<?php date_default_timezone_set('Asia/Jakarta');
echo date('H:i');
?> - <?= TanggalIndonesia(date('Y-m-d')) ?>" id="jam" />
  </div>
   
  <br>
<div><button class="btn tambah" style="width: 300px">Lanjutkan <span class="glyphicon glyphicon-arrow-right"></span></button>
</div>
</form>
</div>
</body>