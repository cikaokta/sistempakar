<?php
$rows = $db->get_results("SELECT * FROM tb_gejala WHERE kode_gejala IN (SELECT kode_gejala FROM tb_konsultasi WHERE jawaban='Ya')");
if( !$rows ) :
    print_msg('Belum ada gejala terpilih!', 'warning');
    echo '<p><a class="btn btn-primary" href="aksi.php?m=konsu&act=new"><span class="glyphicon glyphicon-refresh"></span> Konsultasi Lagi</a></p>';
else:

?>

<?php
$rows = $db->get_results("SELECT * 
    FROM tb_relasi r INNER JOIN tb_diagnosa d ON d.kode_diagnosa = r.kode_diagnosa      
    WHERE r.kode_gejala IN (SELECT kode_gejala FROM tb_konsultasi WHERE jawaban='Ya') ORDER BY r.kode_diagnosa, r.kode_gejala");

foreach($rows as $row){
   @$diagnosa[$row->kode_diagnosa]['mb'] = $diagnosa[$row->kode_diagnosa]['mb'] + $row->mb * (1 - $diagnosa[$row->kode_diagnosa]['mb']);

    @$diagnosa[$row->kode_diagnosa]['md'] = $diagnosa[$row->kode_diagnosa]['md'] + $row->md * (1 - $diagnosa[$row->kode_diagnosa]['md']);
    
    @$diagnosa[$row->kode_diagnosa]['cf'] = $diagnosa[$row->kode_diagnosa]['mb'] -  $diagnosa[$row->kode_diagnosa]['md'];     
}
?>
<div class="panel panel-default">
    <div class="panel-heading">        
        <h3 class="panel-title"><b>Hasil Analisa</b></h3>
    </div>
    <table class="table table-bordered table-hover ">
    <thead>
        <tr style="background-color: #535c68; color: #fff;">
            <th>No</th>
            <th>Penyakit</th>
            <th>Kepercayaan CF</th>
        </tr>
    </thead>
    <?php
    $no=1;
    function ranking($array){
        $new_arr = array();
        foreach($array as $key => $value) {
            $new_arr[$key] = $value['cf'];
        }
        arsort($new_arr);
                $result = array();    
        foreach($new_arr as $key => $value){
            @$result[$key] = ++$no;
        }    
        return $result;
    }
    $rank = ranking($diagnosa);

    foreach($rank as $key => $value):?>
    <tr class="<?=($value==1) ? 'text-primary' : ''; ?>">
        <td><?=$no++; ?></td>
        <td><b><?=$DIAGNOSA[$key]->nama_diagnosa; ?></b></td>
        <td><?=$diagnosa[$key]['cf'] * 100; ?>%</td>
    </tr>
    <?php endforeach;
    reset($rank);
    ?>
    </table>

    <div class="panel-body">
        <table class="table table-bordered">
            <tr>
                <td>Penyakit</td>
                <td><b><?=$DIAGNOSA[key($rank)]->nama_diagnosa; ?></b></td>
            </tr>
            <tr>
                <td>Solusi</td>
                <td><?=$DIAGNOSA[key($rank)]->solusi; ?></td>
            </tr>
        </table>

        <p>
            <a class="btn edit" href="index.php?m=konsu_lagi"><span class=""></span> Konsultasi Lagi</a>
            <a class="btn edit" href="cetak.php?m=konsu" target="_blank"><span class=""></span> Cetak</a>
        </p>       
    </div>
</div>

<?php endif;?>
<div class="page-header">
    <?php
    require_once 'functions.php';
    $nama =$rowd->nama;
    $no_hp =$rowd->email;
    $jk=$rowd->jk;
    $alamat =$rowd->alamat;
    $tgl =$rowd->tgl;
    $hasildiagnosa=$DIAGNOSA[key($rank)]->nama_diagnosa;

    $mmk=$diagnosa[$key]['cf'] * 100;

    $db->query("INSERT INTO tb_hasil(nama,email,jk,alamat,tgl,hasil_konsultasi,kepercayaan) VALUES('$nama','$email','$jk','$alamat','$tgl','$hasildiagnosa','Positif')");

    //Positif ganti dengan $mmk jika menampilkan nilai CF di Laporan Admin.
    //Nilai CF di Laporan admin belum FIX, karna penyimpanan diambil dari nilai CF terakhir dari daftar hasil diagnosa.
    ?>

