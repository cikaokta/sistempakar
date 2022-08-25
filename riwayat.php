<body class="latar">
<div class="page-header">
    <h1 style="color: #000;" align="center"><b>Riwayat Konsultasi</b></h1>
</div>

<div class="panel panel-default">
    <div class="panel-heading" align="right">        
        <form class="form-inline">
            <input type="hidden" name="m" value="laporan" />
            <div class="form-group">
                <input type="hidden" class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
            </div>        
        </form>
    </div>
<div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
  <tr>
    <td width="50" align="center" valign="middle"><b>No</b></td>
    <td width="150" align="center" valign="middle"><b>Nama</b></td>
    <td width="100" align="center" valign="middle"><b>Email</b></td>
    <td width="100" align="center" valign="middle"><b>Jenis Kelamin</b></td>
    <td width="100" align="center" valign="middle"><b>Alamat</b></td>
    <td width="150" align="center" valign="middle"><b>Tanggal Konsultasi</b></td>
    <td width="70" align="center" valign="middle"><b>Hasil Konsultasi</b></td>
    <td width="70" align="center" valign="middle"><b>Kepercayaan</b></td>
  </tr>

  <?php
 require_once'functions.php';
    $q = esc_field($_GET['q']);
    $rows = $db->get_results("SELECT DISTINCT nama,email,jk,alamat,tgl,hasil_konsultasi,kepercayaan FROM tb_hasil");
    $no=0;
    $rows = $db->get_results("SELECT * FROM tb_hasil 
    WHERE nama LIKE '%$q%' AND kepercayaan > 10
    ORDER BY id");
    foreach($rows as $row):?>
    <tr>
    <td align="center" valign="middle"><?=++$no?></td>
    <td valign="middle"> <?=$row->nama ?></td>
    <td valign="middle"> <?=$row->email ?></td>
    <td valign="middle"> <?=$row->jk ?></td>
    <td valign="middle"> <?=$row->alamat ?></td>
    <td valign="middle"> <?=$row->tgl ?></td>
    <td valign="middle"> <?=$row->hasil_konsultasi ?></td>
    <td align="center" valign="middle"><?=$row->kepercayaan ?></td>
  </tr>
  <?php endforeach;
    ?>
</table>
</div></div>
</body>